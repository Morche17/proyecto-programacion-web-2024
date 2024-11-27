<?php
include("conexion.php");
$con = conectar();

$id_categoria = $_POST['id_categoria'];

// Obtener productos por categoría
$sql = "SELECT * FROM Productos WHERE id_categoria = '$id_categoria'";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos por Categoría</title>
</head>
<body>
    <h1>Productos de la Categoría Seleccionada</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Origen</th>
                <th>Stock</th>
                <th>Dimensiones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['marca']); ?></td>
                    <td><?php echo htmlspecialchars($row['origen']); ?></td>
                    <td><?php echo htmlspecialchars($row['stock']); ?></td>
                    <td><?php echo htmlspecialchars($row['id_dimensiones']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>
    <a href="consulta_categoria.php"><button>Regresar a Selección de Categorías</button></a>
</body>
</html>


