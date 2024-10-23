<?php
include("conexion.php");
$conn = conectar();

// Obtener el ID del cliente a eliminar
$id_cliente = $_POST['id'];

// Eliminar el cliente de la base de datos
$sql = "DELETE FROM Clientes WHERE id = '$id_cliente'";
$query = mysqli_query($conn, $sql);

if ($query) {
    // Redirigir de vuelta a la página de eliminación después de eliminar
    header("Location: eliminar_cliente.php");
    exit();
} else {
    echo "Error al eliminar el cliente: " . mysqli_error($conn);
}
?>

