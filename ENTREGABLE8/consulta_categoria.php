<?php
include("conexion.php");
$con = conectar();

// Obtener todas las categorías
$sql_categorias = "SELECT * FROM Categoria";
$result_categorias = mysqli_query($con, $sql_categorias);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Productos por Categoría</title>
    <!-- Vincula Bootstrap desde su CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 600px;">
            <div class="text-center mb-4">
                <h1>Ver Productos por Categoría</h1>
            </div>

            <form action="productos_categoria.php" method="POST">
                <div class="mb-3">
                    <label for="id_categoria" class="form-label">Seleccionar Categoría:</label>
                    <select name="id_categoria" class="form-select" required>
                        <?php while($row = mysqli_fetch_assoc($result_categorias)) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nombre']); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Ver Productos</button>
            </form>

            <br>
            <div class="text-center">
                <a href="principal.php" class="btn btn-secondary w-100">Regresar al Menú de Categorías</a>
            </div>
        </div>
    </div>

    <!-- Vincula el archivo de Bootstrap desde su CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
