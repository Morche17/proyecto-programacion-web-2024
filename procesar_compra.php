<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Iniciar sesión
session_start();

// Incluir archivo de conexión
include('conexion.php');

// Conectar a la base de datos
$conn = conectar();

// Verificar si el usuario está logueado y tiene un ClienteID en la sesión
if (!isset($_SESSION['ClienteID'])) {
    die("No estás logueado. Por favor, inicia sesión para realizar la compra.");
}

$ClienteID = $_SESSION['ClienteID']; // Obtener ClienteID desde la sesión
$CarritoID = $_SESSION['CarritoID']; // Obtener CarritoID desde la sesión

// Verificar si hay productos en el carrito
$sql_carrito = "SELECT * FROM Carrito_Productos WHERE CarritoID = $CarritoID";
$result_carrito = mysqli_query($conn, $sql_carrito);

if (mysqli_num_rows($result_carrito) == 0) {
    die("No hay productos en el carrito.");
}

// Asignar un repartidor aleatorio
$sql_repartidor = "SELECT RepartidorID FROM Repartidores ORDER BY RAND() LIMIT 1";
$result_repartidor = mysqli_query($conn, $sql_repartidor);
$row_repartidor = mysqli_fetch_assoc($result_repartidor);
$RepartidorID = $row_repartidor['RepartidorID'];

// Insertar la ficha de entrega
$sql_ficha = "INSERT INTO FichasEntrega (CarritoID, RepartidorID, EstadoEntrega) VALUES ($CarritoID, $RepartidorID, 'Pendiente')";
if ($conn->query($sql_ficha) === TRUE) {
    $FichaEntregaID = $conn->insert_id;

    // Vaciar el carrito
    $sql_vaciar_carrito = "DELETE FROM Carrito_Productos WHERE CarritoID = $CarritoID";
    $conn->query($sql_vaciar_carrito);

    echo "Compra procesada con éxito. Ficha de entrega generada con ID: $FichaEntregaID";
} else {
    die("Error al procesar la compra: " . $conn->error);
}
?>

