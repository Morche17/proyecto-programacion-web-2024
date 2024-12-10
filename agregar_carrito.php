<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Asegúrate de iniciar la sesión

// Importar la función de conexión
include 'conexion.php';

// Conectar a la base de datos
$conn = conectar();

// Validar que los campos requeridos existen y no están vacíos
if (!isset($_SESSION['carritoID'], $_POST['productoID'], $_POST['cantidad']) || 
    empty($_SESSION['carritoID']) || 
    empty($_POST['productoID']) || 
    empty($_POST['cantidad'])) {
    die("Error: Todos los campos son obligatorios.");
}

// Obtener datos
$carritoID = $_SESSION['carritoID'];
$productoID = $_POST['productoID'];
$cantidad = $_POST['cantidad'];

// Obtener el precio unitario del producto desde la tabla 'Productos'
$query = "SELECT precio FROM Productos WHERE id = '$productoID'";
$result = mysqli_query($conn, $query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $precioUnitario = $row['precio'];
} else {
    die("Error: Producto no encontrado.");
}

// Calcular el subtotal
$subtotal = $precioUnitario * $cantidad;

// Insertar el producto en el carrito
$insertQuery = "INSERT INTO Carrito_Productos (CarritoID, ProductoID, Cantidad, PrecioUnitario, Subtotal) 
                VALUES ('$carritoID', '$productoID', '$cantidad', '$precioUnitario', '$subtotal')";

if (mysqli_query($conn, $insertQuery)) {
    echo "Producto agregado al carrito correctamente.";
} else {
    echo "Error al agregar producto al carrito: " . mysqli_error($conn);
}

// Cerrar conexión
mysqli_close($conn);
?>

