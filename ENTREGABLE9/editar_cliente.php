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
$sql = "SELECT * FROM Clientes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$resultado = $stmt->get_result();
$cliente = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <!-- Vincula Bootstrap desde su CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .back-button {
            margin-top: 20px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <h1 class="text-center mb-4">Editar Cliente</h1>
        
        <form action="actualizar_usuario_proceso.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($cliente['id']); ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($cliente['name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="app" class="form-label">Apellido Paterno:</label>
                <input type="text" name="app" class="form-control" value="<?php echo htmlspecialchars($cliente['app']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="apm" class="form-label">Apellido Materno:</label>
                <input type="text" name="apm" class="form-control" value="<?php echo htmlspecialchars($cliente['apm']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="dir" class="form-label">Dirección:</label>
                <input type="text" name="dir" class="form-control" value="<?php echo htmlspecialchars($cliente['dir']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="cp" class="form-label">Código Postal:</label>
                <input type="text" name="cp" class="form-control" value="<?php echo htmlspecialchars($cliente['cp']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="tel" class="form-label">Teléfono:</label>
                <input type="text" name="tel" class="form-control" value="<?php echo htmlspecialchars($cliente['tel']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="mail" class="form-label">Correo Electrónico:</label>
                <input type="email" name="mail" class="form-control" value="<?php echo htmlspecialchars($cliente['mail']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="actualizar_usuario.php" class="btn btn-secondary">Cancelar</a>
        </form>

    </div>

    <!-- Vincula el archivo de Bootstrap desde su CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
