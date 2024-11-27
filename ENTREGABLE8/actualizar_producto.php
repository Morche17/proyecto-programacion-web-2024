<?php
include('conexion.php');
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
    <title>Actualizar Producto</title>
    <!-- Vincula Bootstrap desde su CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 600px;">
            <div class="text-center mb-4">
                <h1>Actualizar Producto</h1>
            </div>
            <form action="actualizar_producto_proceso.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="id_producto" class="form-label">ID del Producto:</label>
                    <input type="number" id="id_producto" name="id_producto" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nuevo Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="marca" class="form-label">Nueva Marca:</label>
                    <input type="text" id="marca" name="marca" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="origen" class="form-label">Nuevo Origen:</label>
                    <input type="text" id="origen" name="origen" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Nueva Categoría:</label>
                    <select id="categoria" name="categoria" class="form-select" required>
                        <?php while($row = mysqli_fetch_assoc($result_categorias)) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nombre']); ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="volumen" class="form-label">Nuevo Volumen (cm³):</label>
                    <input type="number" id="volumen" name="volumen" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="peso" class="form-label">Nuevo Peso (g):</label>
                    <input type="number" id="peso" name="peso" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Nuevo Stock:</label>
                    <input type="number" id="stock" name="stock" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Nuevo Precio:</label>
                    <input type="number" id="precio" name="precio" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="fotografia" class="form-label">Nueva Fotografía (JPG o PNG):</label>
                    <input type="file" id="fotografia" name="fotografia" class="form-control">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Actualizar Producto</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Vincula el archivo de Bootstrap desde su CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
