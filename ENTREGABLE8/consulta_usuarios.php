<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}

include("conexion.php");
$conn = conectar();

// Ejecutar la consulta para obtener clientes
$query = "SELECT * FROM Clientes WHERE rol='user' OR rol='admin'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Clientes</title>
    <!-- Vincula Bootstrap para mejorar el estilo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        table {
            margin: 20px auto;
            width: 90%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center my-4">Lista de Clientes Registrados</h1>

        <!-- Mostrar tabla de clientes -->
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Dirección</th>
                    <th>Código Postal</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['app']); ?></td>
                        <td><?php echo htmlspecialchars($row['apm']); ?></td>
                        <td><?php echo htmlspecialchars($row['dir']); ?></td>
                        <td><?php echo htmlspecialchars($row['cp']); ?></td>
                        <td><?php echo htmlspecialchars($row['tel']); ?></td>
                        <td><?php echo htmlspecialchars($row['mail']); ?></td>
                        <td><?php echo htmlspecialchars($row['rol']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Botón para regresar al panel de administración -->
        <div class="text-center btn-back">
            <a href="principal.php" class="btn btn-danger">Volver al Panel de Administración</a>
        </div>
    </div>

    <!-- Vincula el script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
