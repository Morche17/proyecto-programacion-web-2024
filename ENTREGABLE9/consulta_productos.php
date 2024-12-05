<?php
include("conexion.php");
$con = conectar();

// Consulta para obtener todos los productos
$query = "SELECT p.id, p.nombre, p.marca, p.origen, p.fotografia, p.stock, 
                 c.nombre AS categoria, d.volumen, d.peso
          FROM Productos p
          LEFT JOIN Categoria c ON p.id_categoria = c.id
          LEFT JOIN Dimensiones d ON p.id_dimensiones = d.id";

// Ejecutar la consulta y verificar si es exitosa
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Productos</title>
  <!-- Vincula Bootstrap desde su CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .img-thumbnail {
      max-width: 100px;
      max-height: 100px;
      object-fit: cover;
    }
  </style>
</head>

<body class="bg-light">
  <div class="container my-5">
    <!-- Botón para regresar al índice de productos, colocado en la parte superior -->
    <div class="text-center mb-4">
      <button onclick="window.location.href='principal.php'" class="btn btn-danger">Volver al Menú Principal</button>
    </div>

    <h1 class="text-center mb-4">Lista de Productos Registrados</h1>

    <table class="table table-bordered table-striped table-hover">
      <thead class="table-light">
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
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
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
              <img src="data:image/jpeg;base64,<?php echo base64_encode($row['fotografia']); ?>" alt="Imagen del producto" class="img-thumbnail">
            <?php } else { ?>
              No disponible
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <!-- Botón para regresar al índice de productos -->
    <div class="text-center mt-4">
      <button onclick="window.location.href='principal.php'" class="btn btn-danger">Volver</button>
    </div>
  </div>

  <!-- Vincula el archivo de Bootstrap desde su CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
