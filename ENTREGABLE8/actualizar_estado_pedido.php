<?php
session_start();
require 'conexion.php';

// Verificar si el usuario tiene rol de admin
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.html");
    exit();
}

$conn = conectar();

// Obtener todos los pedidos
$sql = "SELECT fe.FichaEntregaID, fe.FechaGeneracion, fe.EstadoEntrega, c.ClienteID 
        FROM FichasEntrega fe
        JOIN Carritos c ON fe.CarritoID = c.CarritoID
        ORDER BY fe.FechaGeneracion DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Estado de Pedidos</title>
</head>
<body>
    <h1>Actualizar Estado de Pedidos</h1>
    <table border="1">
        <tr>
            <th>ID Pedido</th>
            <th>Fecha de Generación</th>
            <th>Estado Actual</th>
            <th>ID Cliente</th>
            <th>Nuevo Estado</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <form action="procesar_actualizacion_estado.php" method="post">
                    <td><?= htmlspecialchars($row['FichaEntregaID']) ?></td>
                    <td><?= htmlspecialchars($row['FechaGeneracion']) ?></td>
                    <td><?= htmlspecialchars($row['EstadoEntrega']) ?></td>
                    <td><?= htmlspecialchars($row['ClienteID']) ?></td>
                    <td>
                        <input type="hidden" name="FichaEntregaID" value="<?= htmlspecialchars($row['FichaEntregaID']) ?>">
                        <select name="EstadoEntrega" required>
                            <option value="Pendiente" <?= $row['EstadoEntrega'] === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                            <option value="En Camino" <?= $row['EstadoEntrega'] === 'En Camino' ? 'selected' : '' ?>>En Camino</option>
                            <option value="Entregado" <?= $row['EstadoEntrega'] === 'Entregado' ? 'selected' : '' ?>>Entregado</option>
                        </select>
                        <button type="submit">Actualizar</button>
                    </td>
                </form>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="principal.php">Regresar</a>
</body>
</html>

<?php
$conn->close();
?>

