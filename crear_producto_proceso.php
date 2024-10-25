<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir la conexión a la base de datos
include("conexion.php");
$conn = conectar();

// Obtener los valores del formulario
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$origen = $_POST['origen'];
$id_categoria = $_POST['id_categoria'];
$volumen = $_POST['volumen'];
$peso = $_POST['peso'];
$stock = $_POST['stock'];

// Procesar la imagen (si se sube una)
$fotografia = null;
if (isset($_FILES['fotografia']) && $_FILES['fotografia']['error'] == 0) {
    $fotografia = addslashes(file_get_contents($_FILES['fotografia']['tmp_name']));
}

// Insertar las nuevas dimensiones
$sql_insert_dimensiones = "INSERT INTO Dimensiones (volumen, peso) VALUES ('$volumen', '$peso')";

if (mysqli_query($conn, $sql_insert_dimensiones)) {
    // Obtener el ID de las dimensiones recién insertadas
    $id_dimensiones = mysqli_insert_id($conn);

    // Insertar el nuevo producto con el ID de las dimensiones
    $sql = "INSERT INTO Productos (nombre, marca, origen, fotografia, id_categoria, stock, id_dimensiones)
            VALUES ('$nombre', '$marca', '$origen', '$fotografia', '$id_categoria', '$stock', '$id_dimensiones')";

    if (mysqli_query($conn, $sql)) {
        echo "Registro de producto exitoso. Redirigiendo al index...";
        header("refresh:3;url=admin_productos_index.html");
        exit();
    } else {
        echo "Error al registrar el producto: " . mysqli_error($conn);
    }

} else {
    echo "Error al registrar las dimensiones: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>

