<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}

include("conexion.php");
$conn = conectar();

$id_cliente = $_POST['id'];

$sql = "DELETE FROM Clientes WHERE id = '$id_cliente'";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "Eliminación realizada con éxito. Redirigiendo...";
    header("refresh:3;url=eliminar_cliente.php");
    exit();
} else {
    echo "Error al eliminar el cliente: " . mysqli_error($conn);
}
?>

