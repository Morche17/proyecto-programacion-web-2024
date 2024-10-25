<?php
include("conexion.php");
$conn = conectar();

// Obtener los datos actualizados del formulario
$id_cliente = $_POST['id'];
$nombre = $_POST['nombre'];
$app = $_POST['app'];
$apm = $_POST['apm'];
$direccion = $_POST['dir'];
$codigo_postal = $_POST['cp'];
$telefono = $_POST['tel'];
$correo = $_POST['mail'];

// Actualizar los datos en la base de datos
$sql = "UPDATE Clientes 
        SET nombre='$nombre', app='$app', apm='$apm', dir='$direccion', cp='$codigo_postal', tel='$telefono', mail='$correo' 
        WHERE id='$id_cliente'";

$query = mysqli_query($conn, $sql);

if ($query) {
    // Redirigir de vuelta a la página de actualización después de modificar los datos
    echo "Actualización realizada con éxito";
    header("refresh:3;url=admin_clientes_index.html");
    exit();
} else {
    echo "Error al actualizar el cliente: " . mysqli_error($conn);
}
?>

