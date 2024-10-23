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
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"], input[type="number"], input[type="file"], select {
            padding: 5px;
            width: 200px;
            margin-top: 5px;
        }

        button {
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Actualizar Producto</h1>
    <form action="actualizar_producto_proceso.php" method="post" enctype="multipart/form-data">
        <label for="id_producto">ID del Producto:</label>
        <input type="number" id="id_producto" name="id_producto" required>

        <label for="nombre">Nuevo Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="marca">Nueva Marca:</label>
        <input type="text" id="marca" name="marca" required>

        <label for="origen">Nuevo Origen:</label>
        <input type="text" id="origen" name="origen" required>

        <label for="categoria">Nueva Categoría:</label>
        <select id="categoria" name="categoria" required>
            <?php while($row = mysqli_fetch_assoc($result_categorias)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nombre']); ?></option>
            <?php } ?>
        </select>

        <label for="volumen">Nuevo Volumen (cm³):</label>
        <input type="number" id="volumen" name="volumen" required>

        <label for="peso">Nuevo Peso (g):</label>
        <input type="number" id="peso" name="peso" required>

        <label for="stock">Nuevo Stock:</label>
        <input type="number" id="stock" name="stock" required>

        <label for="fotografia">Nueva Fotografía (JPG o PNG):</label>
        <input type="file" id="fotografia" name="fotografia">

        <button type="submit">Actualizar Producto</button>
    </form>
</body>
</html>

