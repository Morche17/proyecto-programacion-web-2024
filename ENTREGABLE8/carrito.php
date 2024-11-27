<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require 'conexion.php';

$conn = conectar();

// Verificar si hay un carrito activo en la sesión
if (!isset($_SESSION['carritoID'])) {
    die("No hay un carrito activo.");
}

$carritoID = $_SESSION['carritoID'];

// Si se confirma la compra
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_compra'])) {
    // Iniciar transacción
    $conn->begin_transaction();
    try {
        // Crear la ficha de entrega
        $sqlFicha = "INSERT INTO FichasEntrega (CarritoID, RepartidorID, EstadoEntrega) VALUES (?, 1, 'Pendiente')";
        $stmtFicha = $conn->prepare($sqlFicha);
        $stmtFicha->bind_param('i', $carritoID);
        $stmtFicha->execute();
        $fichaEntregaID = $conn->insert_id;

        // Obtener productos del carrito para llenar los detalles
        $sqlProductos = "SELECT ProductoID, Cantidad, Subtotal FROM Carrito_Productos WHERE CarritoID = ?";
        $stmtProductos = $conn->prepare($sqlProductos);
        $stmtProductos->bind_param('i', $carritoID);
        $stmtProductos->execute();
        $resultProductos = $stmtProductos->get_result();

        // Insertar detalles de la ficha de entrega
        $sqlDetalles = "INSERT INTO FichaEntrega_Detalles (FichaEntregaID, ProductoID, Cantidad, Subtotal) VALUES (?, ?, ?, ?)";
        $stmtDetalles = $conn->prepare($sqlDetalles);

        while ($row = $resultProductos->fetch_assoc()) {
            $stmtDetalles->bind_param('iiid', $fichaEntregaID, $row['ProductoID'], $row['Cantidad'], $row['Subtotal']);
            $stmtDetalles->execute();
        }

        // Actualizar el estado del carrito a 'Pagado'
        $sqlActualizarCarrito = "UPDATE Carritos SET Estado = 'Pagado' WHERE CarritoID = ?";
        $stmtActualizarCarrito = $conn->prepare($sqlActualizarCarrito);
        $stmtActualizarCarrito->bind_param('i', $carritoID);
        $stmtActualizarCarrito->execute();

        // Vaciar el carrito
        $sqlVaciarCarrito = "DELETE FROM Carrito_Productos WHERE CarritoID = ?";
        $stmtVaciarCarrito = $conn->prepare($sqlVaciarCarrito);
        $stmtVaciarCarrito->bind_param('i', $carritoID);
        $stmtVaciarCarrito->execute();

        // Confirmar transacción
        $conn->commit();

        // Mostrar mensaje y redirigir
        echo "<p>Compra exitosa. Redirigiendo a la tienda...</p>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'principal.php';
                }, 3000); // 3 segundos de espera
              </script>";
        exit;

    } catch (Exception $e) {
        $conn->rollback(); // Revertir cambios en caso de error
        die("Error al confirmar la compra: " . $e->getMessage());
    }
}

// Consultar los productos del carrito
$sql = "SELECT cp.ProductoID, p.nombre, p.marca, cp.Cantidad, cp.PrecioUnitario, cp.Subtotal 
        FROM Carrito_Productos cp
        JOIN Productos p ON cp.ProductoID = p.id
        WHERE cp.CarritoID = $carritoID";

$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Producto</th>
                <th>Marca</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['marca']) ?></td>
                    <td><?= htmlspecialchars($row['Cantidad']) ?></td>
                    <td>$<?= htmlspecialchars($row['PrecioUnitario']) ?></td>
                    <td>$<?= htmlspecialchars($row['Subtotal']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <form method="post">
            <button type="submit" name="confirmar_compra">Confirmar Compra</button>
        </form>
    <?php else: ?>
        <p>No hay productos en el carrito.</p>
    <?php endif; ?>
    <br>
    <a href="tienda.php">Regresar a la tienda</a>
</body>
</html>

<?php
$conn->close();
?>

