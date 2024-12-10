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

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Estado de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Actualizar Estado de Pedidos</h1>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID Pedido</th>
                    <th>Fecha de Generación</th>
                    <th>Estado Actual</th>
                    <th>ID Cliente</th>
                    <th>Nuevo Estado</th>
                </tr>
            </thead>
            <tbody>
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
                                <button type="submit" class="btn btn-warning btn-sm">Actualizar</button>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="principal.php"><button class="btn btn-danger">Regresar</button></a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
