<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'conexion.php';  // Asegúrate de incluir el archivo de conexión

if (!isset($_SESSION['id_cliente'])) {
    header("Location: principal.php");
    exit();
}

$id_cliente = $_SESSION['id_cliente'];

// Llamar a la función conectar() para obtener la conexión
$conn = conectar();

try {
    // Recuperar el carrito asociado al cliente
    $sql_carrito = "SELECT id, SUM(subtotal) AS total FROM Carritos WHERE id_cliente = $id_cliente GROUP BY id_cliente";
    $result_carrito = mysqli_query($conn, $sql_carrito);

    if ($result_carrito && mysqli_num_rows($result_carrito) > 0) {
        $carrito = mysqli_fetch_assoc($result_carrito);
        $id_carrito = $carrito['id'];
        $total = $carrito['total'];

        // Confirmar compra
        $sql_compra = "INSERT INTO Compras (id_carrito, total) VALUES ($id_carrito, $total)";
        if (mysqli_query($conn, $sql_compra)) {
            $id_compra = mysqli_insert_id($conn); // Obtener el ID de la compra recién creada

            // Asignar un repartidor aleatorio para la entrega
            $sql_repartidor = "SELECT id FROM Repartidores ORDER BY RAND() LIMIT 1";
            $result_repartidor = mysqli_query($conn, $sql_repartidor);

            if ($result_repartidor && mysqli_num_rows($result_repartidor) > 0) {
                $repartidor = mysqli_fetch_assoc($result_repartidor);
                $id_repartidor = $repartidor['id'];

                // Crear la entrega
                $sql_entrega = "INSERT INTO Entregas (id_repartidor, id_cliente, fecha_entrega, estado) 
                                VALUES ($id_repartidor, $id_cliente, NOW(), 'Pendiente')";
                mysqli_query($conn, $sql_entrega);
            }

            // Redirigir a la página principal
            header("Location: principal.php");
            exit();
        } else {
            throw new Exception("Error al confirmar la compra: " . mysqli_error($conn));
        }
    } else {
        throw new Exception("No se encontró un carrito para este cliente.");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

// Cerrar la conexión
mysqli_close($conn);
?>
