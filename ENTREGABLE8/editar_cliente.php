<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}
include("conexion.php");
$conn = conectar();

// Obtener el ID del cliente desde la URL
$id_cliente = $_GET['id'];

// Obtener los datos actuales del cliente
$sql = "SELECT * FROM Clientes WHERE id = '$id_cliente'";
$resultado = mysqli_query($conn, $sql);
$cliente = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>

<body>
    <h1>Editar Cliente</h1>
    <form action="actualizar_proceso.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="name" value="<?php echo $cliente['name']; ?>"><br>
        <label for="app">Apellido Paterno:</label>
        <input type="text" name="app" value="<?php echo $cliente['app']; ?>"><br>
        <label for="apm">Apellido Materno:</label>
        <input type="text" name="apm" value="<?php echo $cliente['apm']; ?>"><br>
        <label for="dir">Dirección:</label>
        <input type="text" name="dir" value="<?php echo $cliente['dir']; ?>"><br>
        <label for="cp">Código Postal:</label>
        <input type="text" name="cp" value="<?php echo $cliente['cp']; ?>"><br>
        <label for="tel">Teléfono:</label>
        <input type="text" name="tel" value="<?php echo $cliente['tel']; ?>"><br>
        <label for="mail">Correo Electrónico:</label>
        <input type="text" name="mail" value="<?php echo $cliente['mail']; ?>"><br>
        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="actualizar_usuario.php"><button>Cancelar</button></a>
</body>

</html>


