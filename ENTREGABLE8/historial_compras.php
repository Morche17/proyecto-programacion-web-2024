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
</head>
<body>
    <h1>Historial de Compras</h1>
    <table border="1">
        <tr>
            <th>ID Pedido</th>
            <th>Fecha de Generación</th>
            <th>Estado</th>
            <th>Total</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['FichaEntregaID']) ?></td>
                <td><?= htmlspecialchars($row['FechaGeneracion']) ?></td>
                <td><?= htmlspecialchars($row['EstadoEntrega']) ?></td>
                <td>$<?= htmlspecialchars($row['Total']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="principal.php">Regresar</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

