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
    <!-- Vincula Bootstrap desde su CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            margin: 0 auto;
            width: 90%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
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
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Eliminar Producto</h1>

        <table class="table table-bordered table-striped">
            <thead class="table-light">
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
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['marca']); ?></td>
                        <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                        <td>
                            <form action="eliminar_producto_proceso.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="back-button">
            <button onclick="window.location.href='admin_productos_index.html'" class="btn btn-secondary">Regresar al Índice de Productos</button>
        </div>
    </div>

    <!-- Vincula el archivo de Bootstrap desde su CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
