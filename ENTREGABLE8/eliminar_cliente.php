<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}

include("conexion.php");
$conn = conectar();

$sql = "SELECT id, name, app, apm FROM Clientes";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cliente</title>
</head>

<body>
    <h1>Eliminar Cliente</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['app']); ?></td>
                    <td><?php echo htmlspecialchars($row['apm']); ?></td>
                    <td>
                        <form action="eliminar_cliente_proceso.php" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <a href="principal.php"><button>Regresar al Panel de Administración</button></a>
</body>

</html>

