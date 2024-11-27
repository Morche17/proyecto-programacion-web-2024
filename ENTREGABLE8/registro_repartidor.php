<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}
session_start();
include('conexion.php');
$conn = conectar();

// Verificar si el usuario es administrador
if ($_SESSION['rol'] !== 'admin') {
    echo "Acceso denegado. Esta funcionalidad es solo para administradores.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Repartidor</title>
</head>
<body>
    <h1>Registrar Repartidor</h1>
    <form action="registro_repartidor_proceso.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="tel">Teléfono:</label>
        <input type="text" id="tel" name="tel" required><br><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <button type="submit">Registrar Repartidor</button>
    </form>
</body>
</html>

