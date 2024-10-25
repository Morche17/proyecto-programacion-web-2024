<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");
$conn = conectar();

// Recibir los datos del formulario
$mail = $_POST['mail'];
$password = $_POST['password'];

// Buscar al usuario en la base de datos por el correo electrónico
$sql = "SELECT * FROM Clientes WHERE mail = '$mail'";
$result = mysqli_query($conn, $sql);

// Verificar si el usuario existe
if (mysqli_num_rows($result) > 0) {
    $usuario = mysqli_fetch_assoc($result);
    
    // Verificar la contraseña con password_verify
    if (password_verify($password, $usuario['password'])) {
        // Contraseña correcta, verificar el rol
        if ($usuario['rol'] == 'admin') {
            // Redirigir a la página de administrador
            header("Location: admin_index.html");
            exit();
        } else {
            // Redirigir a la página de usuario normal
            header("Location: user_index.html");
            exit();
        }
    } else {
        // Contraseña incorrecta
        echo "La contraseña es incorrecta.";
    }
} else {
    // Usuario no encontrado
    echo "El correo electrónico no está registrado.";
}

// Cerrar conexión
mysqli_close($conn);
?>

