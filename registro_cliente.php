<?php
// Mostrar errores para depurar
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");
$conn = conectar();

// Recibir los datos del formulario
$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
$app = mysqli_real_escape_string($conn, $_POST['app']);
$apm = mysqli_real_escape_string($conn, $_POST['apm']);
$dir = mysqli_real_escape_string($conn, $_POST['dir']);
$cp = mysqli_real_escape_string($conn, $_POST['cp']);
$tel = mysqli_real_escape_string($conn, $_POST['tel']);
$mail = mysqli_real_escape_string($conn, $_POST['mail']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

// Verificar que las contraseñas coincidan
if ($password !== $confirm_password) {
    die("Error: Las contraseñas no coinciden.");
}

// Cifrar la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertar el usuario en la base de datos
$sql = "INSERT INTO Clientes (nombre, app, apm, dir, cp, tel, mail, password) 
        VALUES ('$nombre', '$app', '$apm', '$dir', '$cp', '$tel', '$mail', '$hashed_password')";

if (mysqli_query($conn, $sql)) {
    echo "Usuario registrado exitosamente.";
    header("Location: general_index.html");  // Redirigir a la página de login
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>

