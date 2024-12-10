<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit();
}

// Obtener el rol del usuario
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - VirtualMarket</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">


<?php if ($rol == 'admin'): ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="home.php">VIRTUALMARKET</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="principal.php">Panel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sobre_nosotros.php">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container text-center my-5">
        <h1 class="display-4 fw-bold">Bienvenido, administrador de VirtualMarket</h1>
        <p class="lead">Desarrolladores como tú hacen posible que nuestro equipo crezca y que nuestros clientes se sientan bien en nuestra tienda.</p>
        <a href="principal.php" class="btn btn-primary btn-lg">Panel de Administración</a>
    </div>

<?php else: ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="home.php">VIRTUALMARKET</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="principal.php">Tienda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sobre_nosotros.php">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container text-center my-5">
        <h1 class="display-4 fw-bold">Bienvenido a VirtualMarket</h1>
        <p class="lead">Tu tienda virtual de confianza. Explora nuestros productos y disfruta de la mejor experiencia de compra en línea.</p>
        <a href="principal.php" class="btn btn-primary btn-lg">Explorar la Tienda</a>
    </div>

    <!-- Información de la empresa -->
    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-6">
                <h2>Misión</h2>
                <p>Ofrecer productos de calidad a precios accesibles, con un servicio excepcional que garantice la satisfacción de nuestros clientes.</p>
            </div>
            <div class="col-md-6">
                <h2>Visión</h2>
                <p>Ser líderes en el mercado virtual, reconocidos por nuestra innovación, servicio al cliente y compromiso con la excelencia.</p>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">&copy; 2024 VirtualMarket. Todos los derechos reservados.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
