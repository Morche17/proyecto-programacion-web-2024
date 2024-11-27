<?php
session_start();
require 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit();
}

$clienteID = $_SESSION['id']; // ID del usuario autenticado
$conn = conectar();

// Obtener el historial de compras
$sql = "SELECT fe.FichaEntregaID, fe.FechaGeneracion, fe.EstadoEntrega, SUM(fd.Subtotal) AS Total 
        FROM FichasEntrega fe
        JOIN FichaEntrega_Detalles fd ON fe.FichaEntregaID = fd.FichaEntregaID
        WHERE fe.CarritoID IN (
            SELECT CarritoID FROM Carritos WHERE ClienteID = ?
        )
        GROUP BY fe.FichaEntregaID, fe.FechaGeneracion, fe.EstadoEntrega
        ORDER BY fe.FechaGeneracion DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $clienteID);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras</title>
    <!-- Vincula Bootstrap desde su CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Historial de Compras</h1>
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Fecha de Generación</th>
                    <th>Estado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['FichaEntregaID']) ?></td>
                            <td><?= htmlspecialchars($row['FechaGeneracion']) ?></td>
                            <td><?= htmlspecialchars($row['EstadoEntrega']) ?></td>
                            <td>$<?= number_format(htmlspecialchars($row['Total']), 2) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No tienes compras anteriores.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="principal.php" class="btn btn-danger">Regresar</a>
    </div>

    <!-- Vincula el archivo de Bootstrap desde su CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
