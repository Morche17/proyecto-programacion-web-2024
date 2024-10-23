<?php
include("conexion.php");
$conn = conectar();

// Obtener todos los productos
$sql = "SELECT p.id, p.nombre, p.marca, c.nombre AS categoria 
        FROM Productos p 
        LEFT JOIN Categoria c ON p.id_categoria = c.id";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <style>
        table {
            margin: 0 auto;
            width: 80%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .back-button {
            margin-top: 20px;
            text-align: center;
        }

        .back-button button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button button:hover {
            background-color: #e53935;
        }
    </style>
</head>

<body>
    <h1>Eliminar Producto</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Categoría</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['marca']; ?></td>
                    <td><?php echo $row['categoria']; ?></td>
                    <td>
                        <form action="eliminar_producto_proceso.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>
    <div class="back-button">
        <button onclick="window.location.href='productos_index.html'">Regresar al Índice de Productos</button>
    </div>
</body>

</html>

