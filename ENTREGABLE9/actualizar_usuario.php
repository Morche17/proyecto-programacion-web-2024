<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}

include("conexion.php");
$conn = conectar();

// Obtener todos los clientes
$sql = "SELECT id, name, app, apm FROM Clientes";
$resultado = mysqli_query($conn, $sql);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Actualizar Cliente</h1>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
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
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['app']); ?></td>
                        <td><?php echo htmlspecialchars($row['apm']); ?></td>
                        <td>
                            <a href="editar_cliente.php?id=<?php echo $row['id']; ?>"><button class="btn btn-warning btn-sm">Actualizar</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="principal.php"><button class="btn btn-danger">Regresar al Inicio</button></a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
