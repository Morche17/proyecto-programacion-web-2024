<?php
include("conexion.php");
$conn = conectar();

// Obtener todos los clientes
$sql = "SELECT id, nombre, app, apm FROM Clientes";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cliente</title>
</head>

<body>
    <h1>Actualizar Cliente</h1>
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
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['app']; ?></td>
                    <td><?php echo $row['apm']; ?></td>
                    <td>
                        <a href="editar_cliente.php?id=<?php echo $row['id']; ?>"><button>Actualizar</button></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>
    <a href="index.html"><button>Regresar al Inicio</button></a>
</body>

</html>

