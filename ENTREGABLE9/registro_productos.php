<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}
include("conexion.php");
$conn = conectar();

// Obtener todas las categorías
$sql_categorias = "SELECT * FROM Categoria";
$result_categorias = mysqli_query($conn, $sql_categorias);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>
    <!-- Vincula Bootstrap desde su CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Registrar Producto</h1>

        <form action="registro_productos_proceso.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del producto:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="marca" class="form-label">Marca:</label>
                <input type="text" id="marca" name="marca" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="origen" class="form-label">Origen:</label>
                <input type="text" id="origen" name="origen" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="fotografia" class="form-label">Fotografía:</label>
                <input type="file" id="fotografia" name="fotografia" class="form-control" accept="image/jpeg, image/png">
            </div>

            <div class="mb-3">
                <label for="id_categoria" class="form-label">Seleccionar Categoría:</label>
                <select name="id_categoria" class="form-select" required>
                    <?php while($row = mysqli_fetch_assoc($result_categorias)) { ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nombre']); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="volumen" class="form-label">Volumen (en cm³):</label>
                <input type="number" id="volumen" name="volumen" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="peso" class="form-label">Peso (en gramos):</label>
                <input type="number" id="peso" name="peso" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number" id="stock" name="stock" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" id="precio" name="precio" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Producto</button>
        </form>

        <br>
        <a href="principal.php"><button class="btn btn-danger">Regresar</button></a>
    </div>

    <!-- Vincula el archivo de Bootstrap desde su CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
