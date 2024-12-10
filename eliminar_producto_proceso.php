<?php
include("conexion.php");
$con = conectar();

// Obtener el ID del producto a eliminar
$id_producto = $_POST['id'];

// Eliminar el producto de la base de datos
$sql = "DELETE FROM Productos WHERE id = '$id_producto'";
$query = mysqli_query($con, $sql);

if ($query) {
    // Redirigir de vuelta a la página de eliminación después de eliminar
    header("Location: eliminar_producto.php");
    exit();
} else {
    echo "Error al eliminar el producto: " . mysqli_error($con);
}
?>

