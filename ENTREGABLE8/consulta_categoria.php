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
</head>
<body>
    <h1>Ver Productos por Categoría</h1>

    <form action="productos_categoria.php" method="POST">
        <label for="id_categoria">Seleccionar Categoría:</label>
        <select name="id_categoria">
            <?php while($row = mysqli_fetch_assoc($result_categorias)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nombre']); ?></option>
            <?php } ?>
        </select>
        <button type="submit">Ver Productos</button>
    </form>

    <br>
    <a href="principal.php"><button>Regresar al Menú de Categorías</button></a>
</body>
</html>

