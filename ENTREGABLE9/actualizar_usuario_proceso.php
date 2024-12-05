<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}
include("conexion.php");
$conn = conectar();

// Obtener los datos actualizados del formulario
$id_cliente = $_POST['id'];
$nombre = $_POST['name'];
$app = $_POST['app'];
$apm = $_POST['apm'];
$direccion = $_POST['dir'];
$codigo_postal = $_POST['cp'];
$telefono = $_POST['tel'];
$correo = $_POST['mail'];

// Actualizar los datos en la base de datos
$sql = "UPDATE Clientes 
        SET name='$nombre', app='$app', apm='$apm', dir='$direccion', cp='$codigo_postal', tel='$telefono', mail='$correo' 
        WHERE id='$id_cliente'";

$query = mysqli_query($conn, $sql);

if ($query) {
    // Redirigir de vuelta a la página de actualización después de modificar los datos
    echo "Actualización realizada con éxito";
    header("refresh:3;url=principal.php");
    exit();
} else {
    echo "Error al actualizar el cliente: " . mysqli_error($conn);
}
?>


