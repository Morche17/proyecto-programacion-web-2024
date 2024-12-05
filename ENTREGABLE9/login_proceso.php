<?php
session_start();
include("conexion.php");
$conn = conectar();

// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Capturar los datos de inicio de sesión
$mail = $_POST['mail'];
$password = $_POST['password'];

// Consulta para verificar el usuario
$sql = "SELECT * FROM Clientes WHERE mail = '$mail'";
$result = mysqli_query($conn, $sql);

// Verificar si el usuario existe
if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    // Verificar la contraseña
    if (password_verify($password, $user['password'])) {
        // Guardar datos en la sesión
        $_SESSION['id'] = $user['id'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['rol'] = $user['rol'];

        // Redirigir a la página principal
        header("Location: principal.php");
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Correo electrónico no encontrado.";
}

mysqli_close($conn);
?>
