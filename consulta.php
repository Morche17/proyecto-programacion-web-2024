<?php
include("conexion.php");
$conn = conectar();

$query = "SELECT * FROM Clientes";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Clientes</title>
  <style>
    table {
      margin: 0 auto;
      width: 80%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    caption {
      margin-bottom: 10px;
      font-weight: bold;
      font-size: 1.2em;
    }

    .back-button {
      margin-top: 20px;
      text-align: center;
    }

    .back-button button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #f44336;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .back-button button:hover {
      background-color: #e53935;
    }
  </style>
</head>

<body>
  <table>
    <caption>Lista de Clientes Registrados</caption>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Dirección</th>
        <th>Código Postal</th>
        <th>Teléfono</th>
        <th>Correo Electrónico</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
        <td><?php echo htmlspecialchars($row['app']); ?></td>
        <td><?php echo htmlspecialchars($row['apm']); ?></td>
        <td><?php echo htmlspecialchars($row['dir']); ?></td>
        <td><?php echo htmlspecialchars($row['cp']); ?></td>
        <td><?php echo htmlspecialchars($row['tel']); ?></td>
        <td><?php echo htmlspecialchars($row['mail']); ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  <!-- Botón para regresar al index -->
  <div class="back-button">
    <button onclick="window.location.href='general_index.html'">Volver al Inicio</button>
  </div>
</body>

</html>

