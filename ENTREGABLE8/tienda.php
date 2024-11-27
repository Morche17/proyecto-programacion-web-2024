<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'conexion.php';

$conn = conectar();

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    die("No estás logueado. Por favor, inicia sesión para acceder a la tienda.");
}

$clienteID = $_SESSION['id']; // Obtener ClienteID desde la sesión

// Verificar si ya existe un carrito abierto en la sesión
if (!isset($_SESSION['carritoID'])) {
    // Crear un nuevo carrito
    $sql_crear_carrito = "INSERT INTO Carritos (ClienteID, Estado) VALUES ($clienteID, 'Abierto')";
    if ($conn->query($sql_crear_carrito) === TRUE) {
        $_SESSION['carritoID'] = $conn->insert_id; // Guardar CarritoID en la sesión
    } else {
        die("Error al crear el carrito: " . $conn->error);
    }
}

// Obtener los productos disponibles
$sql_productos = "SELECT id, nombre, marca, precio, stock FROM Productos WHERE stock > 0";
$result_productos = $conn->query($sql_productos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
</head>
<body>
    <h1>Productos Disponibles</h1>
    <?php if ($result_productos->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acción</th>
            </tr>
            <?php while ($producto = $result_productos->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($producto['nombre']) ?></td>
                    <td><?= htmlspecialchars($producto['marca']) ?></td>
                    <td>$<?= htmlspecialchars($producto['precio']) ?></td>
                    <td><?= htmlspecialchars($producto['stock']) ?></td>
                    <td>
                    <form action="agregar_carrito.php" method="POST">
                        <input type="hidden" name="carritoID" value="<?= htmlspecialchars($_SESSION['carritoID']) ?>">
                        <input type="hidden" name="productoID" value="<?= htmlspecialchars($producto['id']) ?>">
                        <input type="number" name="cantidad" min="1" max="<?= htmlspecialchars($producto['stock']) ?>" required>
                        <button type="submit">Agregar al carrito</button>
                    </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No hay productos disponibles.</p>
    <?php endif; ?>
    <br>
    <a href="carrito.php">Ver Carrito</a>
</body>
</html>

<?php
$conn->close();
?>

