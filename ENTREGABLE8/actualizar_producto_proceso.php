<?php
include('conexion.php');
$conn = conectar();

// Recibir los datos del formulario
$id_producto = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$origen = $_POST['origen'];
$id_categoria = $_POST['categoria']; // Selección de categoría desde la lista
$volumen = $_POST['volumen'];
$peso = $_POST['peso'];
$stock = $_POST['stock'];
$precio = $_POST['precio'];

// Manejo de la fotografía (si se sube una)
$fotografia = null;
if (isset($_FILES['fotografia']) && $_FILES['fotografia']['error'] === UPLOAD_ERR_OK) {
    $file_type = mime_content_type($_FILES['fotografia']['tmp_name']); // Verificar el tipo MIME

    if ($file_type == 'image/jpeg' || $file_type == 'image/png') {
        $fotografia = addslashes(file_get_contents($_FILES['fotografia']['tmp_name']));
    } else {
        die("Error: Solo se permiten imágenes en formato JPG o PNG.");
    }
}

// Actualizar las dimensiones
$update_dimensiones = "UPDATE Dimensiones 
                       INNER JOIN Productos ON Dimensiones.id = Productos.id_dimensiones
                       SET volumen = '$volumen', peso = '$peso'
                       WHERE Productos.id = '$id_producto'";
if ($conn->query($update_dimensiones) !== TRUE) {
    die("Error al actualizar las dimensiones: " . $conn->error);
}

// Actualizar el producto
$update_producto = "UPDATE Productos 
                    SET nombre='$nombre', marca='$marca', origen='$origen', 
                        fotografia='$fotografia', id_categoria='$id_categoria', stock='$stock', precio='$precio'
                    WHERE id='$id_producto'";
if ($conn->query($update_producto) === TRUE) {
    echo "Producto actualizado exitosamente.";
    header("Location: principal.php");
    exit();
} else {
    echo "Error al actualizar el producto: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>

