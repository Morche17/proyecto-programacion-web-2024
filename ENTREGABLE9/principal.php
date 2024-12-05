<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit();
}

// Obtener el rol del usuario
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIRTUALMARKET</title>
    <!-- Vincula Bootstrap desde su CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 600px;">
            <div class="text-center">
                <h1>VIRTUAL MARKET</h1>
            </div>

            <?php if ($rol == 'admin'): ?>
                <h2 class="text-center mb-4">Bienvenido al Panel de Administración</h2>
                <h3>Gestión de Usuarios</h3>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><a href="registro_usuarios.html">Registrar Usuario/Administrador</a></li>
                    <li class="list-group-item"><a href="consulta_usuarios.php">Consultar Usuarios</a></li>
                    <li class="list-group-item"><a href="actualizar_usuario.php">Actualizar Usuarios</a></li>
                    <li class="list-group-item"><a href="eliminar_cliente.php">Eliminar Usuarios</a></li>
                    <li class="list-group-item"><a href="registro_repartidor.php">Registrar Repartidores</a></li>
                    <li class="list-group-item"><a href="actualizar_estado_pedido.php">Actualización de Estados en los Pedidos</a></li>
                </ul>

                <h3>Gestión de Productos</h3>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><a href="registro_productos.php">Registrar Productos</a></li>
                    <li class="list-group-item"><a href="consulta_productos.php">Consultar Productos</a></li>
                    <li class="list-group-item"><a href="actualizar_producto.php">Actualizar Productos</a></li>
                    <li class="list-group-item"><a href="eliminar_producto.php">Eliminar Productos</a></li>
                    <li class="list-group-item"><a href="crear_categoria.html">Crear Categorías de Productos</a></li>
                    <li class="list-group-item"><a href="consulta_categoria.php">Consultar Categorías de Productos</a></li>
                </ul>

                <div class="text-center">
                    <button onclick="window.location.href='logout.php'" class="btn btn-danger">Cerrar Sesión</button>
                </div>
            <?php else: ?>
                <h2 class="text-center mb-4">Panel de Usuario</h2>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><a href="tienda.php">Consultar productos</a></li>
                    <li class="list-group-item"><a href="historial_compras.php">Consultar historial de pedidos</a></li>
                    <li class="list-group-item"><a href="mis_pedidos.php">Consultar pedidos</a></li>
                </ul>

                <div class="text-center">
                    <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- Vincula el archivo de Bootstrap desde su CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
