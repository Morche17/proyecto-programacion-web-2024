<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('conexion.php');
$conn = conectar();

// Recibir datos del formulario
$name = $_POST['name'];
$app = $_POST['app'];
$apm = $_POST['apm'];
$dir = $_POST['dir'];
$cp = $_POST['cp'];
$tel = $_POST['tel'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validar que las contraseñas coincidan
if ($password !== $confirm_password) {
    die("Las contraseñas no coinciden. Inténtalo de nuevo.");
}

// Cifrar la contraseña
$password_encrypted = password_hash($password, PASSWORD_BCRYPT);

// Determinar el rol
$rol = 'user'; // Por defecto, los registros serán de tipo 'user'

if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
    // Si el administrador está registrando, permite seleccionar el rol
    if (isset($_POST['rol']) && ($_POST['rol'] === 'admin' || $_POST['rol'] === 'user')) {
        $rol = $_POST['rol'];
    }
} elseif (isset($_POST['rol'])) {
    // Si un usuario intenta enviar el rol manualmente, bloquearlo
    die("Acción no permitida.");
}

// Insertar el nuevo usuario en la base de datos
$sql = "INSERT INTO Clientes (name, app, apm, dir, cp, tel, mail, password, rol) 
        VALUES ('$name', '$app', '$apm', '$dir', '$cp', '$tel', '$mail', '$password_encrypted', '$rol')";

if (mysqli_query($conn, $sql)) {
    echo "Registro exitoso.";
    if ($rol === 'user') {
        header("refresh:3;url=principal.php");
    } else {
        header("refresh:3;url=principal.php");
    }
    exit();
} else {
    echo "Error al registrar: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>
