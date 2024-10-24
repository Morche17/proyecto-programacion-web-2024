<?php
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
</head>
<body>
    <h1>Registrar Producto</h1>

    <form action="crear_producto_proceso.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del producto:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required><br>

        <label for="origen">Origen:</label>
        <input type="text" id="origen" name="origen" required><br>

        <label for="fotografia">Fotografía:</label>
        <input type="file" id="fotografia" name="fotografia" accept="image/jpeg, image/png"><br>

        <label for="id_categoria">Seleccionar Categoría:</label>
        <select name="id_categoria" required>
            <?php while($row = mysqli_fetch_assoc($result_categorias)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nombre']); ?></option>
            <?php } ?>
        </select><br>

        <label for="volumen">Volumen (en cm³):</label>
        <input type="number" id="volumen" name="volumen" required><br>

        <label for="peso">Peso (en gramos):</label>
        <input type="number" id="peso" name="peso" required><br>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required><br>

        <button type="submit">Registrar Producto</button>
    </form>

    <br>
    <a href="productos_index.html"><button>Regresar al Menú de Productos</button></a>
</body>
</html>

