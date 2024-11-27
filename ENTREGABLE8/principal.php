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
</head>
<body>
    <h1>VIRTUAL MARKET</h1>

    <?php if ($rol == 'admin'): ?>
        <h1>Bienvenido al Panel de Administración</h1>
        <ul>
            <li><a href="registro_usuarios.html">Registrar Usuario/Administrador</a></li>
            <li><a href="consulta_usuarios.php">Consultar Usuarios</a></li>
            <li><a href="actualizar_usuario.php">Actualizar Usuarios</a></li>
            <li><a href="eliminar_cliente.php">Eliminar Usuarios</a></li>
            <li><a href="registro_repartidor.php">Registrar Repartidores</a></li>
            <li><a href="actualizar_estado_pedido.php">Actualización de Estados en los Pedidos</a></li>
        </ul>
        <h2>Gestión de productos</h2>
        <ul>
            <li><a href="registro_productos.php">Registrar Productos</a></li>
            <li><a href="consulta_productos.php">Consultar Productos</a></li>
            <li><a href="actualizar_producto.php">Actualizar Productos</a></li>
            <li><a href="eliminar_producto.php">Eliminar Productos</a></li>
            <li><a href="crear_categoria.html">Crear Categorías de Productos</a></li>
            <li><a href="consulta_categoria.php">Consultar Categorías de Productos</a></li>
        </ul>
        <br>
        <button onclick="window.location.href='logout.php'">Cerrar Sesión</button>
    <?php else: ?>
        <h2>Panel de Usuario</h2>
        <ul>
            <li><a href="tienda.php">Consultar productos</a></li>
            <li><a href="historial_compras.php">Consultar historial de pedidos</a></li>
            <li><a href="mis_pedidos.php">Consultar pedidos</a></li>
        </ul>
        <br>
        <a href="logout.php">Cerrar Sesión</a>
    <?php endif; ?>
</body>
</html>

