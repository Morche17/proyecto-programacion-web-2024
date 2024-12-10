<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'conexion.php';

$conn = conectar();

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    die("No estás logueado. Por favor, inicia sesión para acceder a la tienda.");
}

$clienteID = $_SESSION['id']; // Obtener ClienteID desde la sesión

// Verificar si ya existe un carrito abierto en la sesión
if (!isset($_SESSION['carritoID'])) {
    // Crear un nuevo carrito
    $sql_crear_carrito = "INSERT INTO Carritos (ClienteID, Estado) VALUES ($clienteID, 'Abierto')";
    if ($conn->query($sql_crear_carrito) === TRUE) {
        $_SESSION['carritoID'] = $conn->insert_id; // Guardar CarritoID en la sesión
    } else {
        die("Error al crear el carrito: " . $conn->error);
    }
}

// Obtener los productos disponibles
$sql_productos = "SELECT id, nombre, marca, precio, stock FROM Productos WHERE stock > 0";
$result_productos = $conn->query($sql_productos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="principal.php">VIRTUALMARKET</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="tienda.php">Tienda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="carrito.php">Ver Carrito</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenido Principal -->
<div class="container my-5">
    <h1 class="text-center">Productos Disponibles</h1>
    <a href="principal.php" class="btn btn-danger my-4">Volver al Menú Principal</a>

    <?php if ($result_productos->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($producto = $result_productos->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($producto['nombre']) ?></td>
                            <td><?= htmlspecialchars($producto['marca']) ?></td>
                            <td>$<?= htmlspecialchars($producto['precio']) ?></td>
                            <td><?= htmlspecialchars($producto['stock']) ?></td>
                            <td>
                                <form action="agregar_carrito.php" method="POST" class="d-flex">
                                    <input type="hidden" name="carritoID" value="<?= htmlspecialchars($_SESSION['carritoID']) ?>">
                                    <input type="hidden" name="productoID" value="<?= htmlspecialchars($producto['id']) ?>">
                                    <input type="number" name="cantidad" min="1" max="<?= htmlspecialchars($producto['stock']) ?>" required class="form-control me-2" style="width: 100px;">
                                    <button type="submit" class="btn btn-success">Agregar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            No hay productos disponibles en este momento.
        </div>
    <?php endif; ?>

    <a href="carrito.php" class="btn btn-primary my-4">Ver Carrito</a>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">&copy; 2024 VirtualMarket. Todos los derechos reservados.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>

