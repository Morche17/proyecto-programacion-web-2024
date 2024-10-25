<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conexion.php');
$conn = conectar();

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$app = $_POST['app'];
$apm = $_POST['apm'];
$dir = $_POST['dir'];
$cp = $_POST['cp'];
$tel = $_POST['tel'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$rol = $_POST['rol']; // Recibir el rol

// Verificar que las contraseñas coincidan
if ($password != $confirm_password) {
    die("Las contraseñas no coinciden.");
}

// Cifrar la contraseña para mayor seguridad
$password_encrypted = password_hash($password, PASSWORD_BCRYPT);

// Insertar el nuevo usuario en la base de datos
$sql = "INSERT INTO Clientes (nombre, app, apm, dir, cp, tel, mail, password, rol) 
        VALUES ('$nombre', '$app', '$apm', '$dir', '$cp', '$tel', '$mail', '$password_encrypted', '$rol')";

if (mysqli_query($conn, $sql)) {
    echo "Registro exitoso. Redirigiendo al index clientes...";
    header("refresh:3;url=admin_clientes_index.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>

