<?php
include("conexion.php");
$con = conectar();

// Consulta para obtener todos los productos
$query = "SELECT p.id, p.nombre, p.marca, p.origen, p.fotografia, p.stock, 
                 c.nombre AS categoria, d.volumen, d.peso
          FROM Productos p
          LEFT JOIN Categoria c ON p.id_categoria = c.id
          LEFT JOIN Dimensiones d ON p.id_dimensiones = d.id";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Productos</title>
  <style>
    table {
      margin: 0 auto;
      width: 90%;
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

    img {
      width: 100px;
      height: auto;
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
    <caption>Lista de Productos Registrados</caption>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Origen</th>
        <th>Categoría</th>
        <th>Volumen (en cm³)</th>
        <th>Peso (en gramos)</th>
        <th>Stock</th>
        <th>Fotografía</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo htmlspecialchars($row['id']); ?></td>
        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
        <td><?php echo htmlspecialchars($row['marca']); ?></td>
        <td><?php echo htmlspecialchars($row['origen']); ?></td>
        <td><?php echo htmlspecialchars($row['categoria']); ?></td>
        <td><?php echo htmlspecialchars($row['volumen']); ?></td>
        <td><?php echo htmlspecialchars($row['peso']); ?></td>
        <td><?php echo htmlspecialchars($row['stock']); ?></td>
        <td>
          <?php if ($row['fotografia']) { ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['fotografia']); ?>" alt="Imagen del producto">
          <?php } else { ?>
            No disponible
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  <!-- Botón para regresar al índice de productos -->
  <div class="back-button">
    <button onclick="window.location.href='productos_index.html'">Volver al Índice de Productos</button>
  </div>
</body>

</html>

