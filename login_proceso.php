<?php
// Mostrar errores para depurar
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");
$conn = conectar();

// Recibir los datos del formulario
$mail = mysqli_real_escape_string($conn, $_POST['mail']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Buscar el usuario por correo
$sql = "SELECT * FROM Clientes WHERE mail = '$mail'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Verificar la contraseña ingresada
    if (password_verify($password, $row['password'])) {
        // Contraseña correcta, iniciar sesión
        session_start();
        $_SESSION['user_id'] = $row['id'];  // Guardar el ID del usuario en la sesión
        $_SESSION['nombre'] = $row['nombre']; // Puedes guardar el nombre del usuario también

        // Redirigir a otra página, por ejemplo, "bienvenida.html"
        header("Location: general_index.html");
        exit();
    } else {
        // Contraseña incorrecta
        echo "Error: Contraseña incorrecta.";
    }
} else {
    // Usuario no encontrado
    echo "Error: Usuario no encontrado.";
}

// Cerrar la conexión
mysqli_close($conn);
?>

