<?php
session_start();
require 'conexion.php';

// Verificar si el usuario tiene rol de admin
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'repartidor') {
    header("Location: index.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fichaEntregaID = $_POST['FichaEntregaID'];
    $estadoEntrega = $_POST['EstadoEntrega'];

    $conn = conectar();

    // Actualizar el estado del pedido
    $sql = "UPDATE FichasEntrega SET EstadoEntrega = ? WHERE FichaEntregaID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $estadoEntrega, $fichaEntregaID);

    if ($stmt->execute()) {
        echo "<script>alert('Estado del pedido actualizado con éxito.'); window.location.href='actualizar_estado_pedido.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el estado del pedido.'); window.location.href='actualizar_estado_pedido.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: principal.php");
    exit();
}
?>

