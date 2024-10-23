<?php

include("conexion.php");
$conn=conectar();

$nombre = $_POST['user_name'];
$apellidop = $_POST['user_app'];
$apellidom = $_POST['user_apm'];
$direccion = $_POST['user_dir'];
$telefono = $_POST['user_tel'];
$codigo_postal = $_POST['user_cp'];
$correo = $_POST['user_mail'];
$pass1 = $_POST['user_pass1'];
$pass2 = $_POST['user_pass2'];

$insertar =  "INSERT INTO Clientes (nombre, app, apm, dir, cp, tel, mail, pass1, pass2) VALUES(
        '$nombre',
        '$apellidop',
        '$apellidom',
        '$direccion',
        '$codigo_postal',
        '$telefono',
        '$correo',
        '$pass1',
        '$pass2')";

$query = mysqli_query($conn, $insertar);

if ($query) {
    // Registro exitoso: redirigir al index.html usando JavaScript
    echo "<script>window.location.href = 'index.html';</script>";
    exit();  // Asegúrate de usar exit para detener el script después de la redirección
} else {
    // Mostrar un mensaje de error si algo salió mal
    echo "Error al insertar datos: " . mysqli_error($conn);
}
?>
