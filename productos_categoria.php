<?php
include("conexion.php");
$con = conectar();

$id_categoria = $_POST['id_categoria'];

// Usar consultas preparadas para evitar inyecciones SQL
$sql = "SELECT p.nombre, p.marca, p.origen, p.stock, d.volumen, d.peso 
        FROM Productos p 
        JOIN Dimensiones d ON p.id_dimensiones = d.id 
        WHERE p.id_categoria = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_categoria);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos por Categoría</title>
    <!-- Vincula Bootstrap desde su CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Productos de la Categoría Seleccionada</h1>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Origen</th>
                    <th>Stock</th>
                    <th>Volumen</th>
                    <th>Peso</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['marca']); ?></td>
                        <td><?php echo htmlspecialchars($row['origen']); ?></td>
                        <td><?php echo htmlspecialchars($row['stock']); ?></td>
                        <td><?php echo htmlspecialchars($row['volumen']); ?> cm³</td>
                        <td><?php echo htmlspecialchars($row['peso']); ?> kg</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="consulta_categoria.php" class="btn btn-danger">Regresar a Selección de Categorías</a>
    </div>

    <!-- Vincula el archivo de Bootstrap desde su CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$con->close();
?>

