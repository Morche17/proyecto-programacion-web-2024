<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");
$conn = conectar();

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$condiciones = $_POST['condiciones'];
$observaciones = $_POST['observaciones'];

// Validar el valor de "condiciones"
$condiciones_validas = ['frio', 'congelado', 'seco'];

if (!in_array($condiciones, $condiciones_validas)) {
    die("Error: Valor de 'condiciones' no válido.");
}

// Preparar la consulta
$sql = "INSERT INTO Categoria (nombre, condiciones, observaciones) VALUES ('$nombre', '$condiciones', '$observaciones')";
$query = mysqli_query($conn, $sql);

// Verificar el resultado de la inserción
if ($query) {
    header("Location: principal.php");
    exit();
} else {
    echo "Error al crear la categoría: " . mysqli_error($conn);
}
?>

