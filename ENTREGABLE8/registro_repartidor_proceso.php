<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}

include('conexion.php');
$conn = conectar();

// Verificar si el usuario es administrador
if ($_SESSION['rol'] !== 'admin') {
    echo "Acceso denegado. Esta funcionalidad es solo para administradores.";
    exit;
}

// Capturar los datos del formulario
$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
$tel = mysqli_real_escape_string($conn, $_POST['tel']);
$correo = mysqli_real_escape_string($conn, $_POST['correo']);

// Insertar el nuevo repartidor en la base de datos
$sql = "INSERT INTO Repartidores (nombre, tel, correo) 
        VALUES ('$nombre', '$tel', '$correo')";

if (mysqli_query($conn, $sql)) {
    echo "Repartidor registrado exitosamente.";
    echo '<br><a href="registro_repartidor.php">Registrar otro repartidor</a>';
} else {
    echo "Error al registrar el repartidor: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
