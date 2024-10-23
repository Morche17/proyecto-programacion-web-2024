<?php
include("conexion.php");
$conn = conectar();

$nombre = $_POST['nombre'];
$condiciones = $_POST['condiciones'];
$observaciones = $_POST['observaciones'];

$sql = "INSERT INTO Categoria (nombre, condiciones, observaciones) VALUES ('$nombre', '$condiciones', '$observaciones')";
$query = mysqli_query($conn, $sql);

if ($query) {
    header("Location: categorias_index.html");
    exit();
} else {
    echo "Error al crear la categoría: " . mysqli_error($con);
}
?>

