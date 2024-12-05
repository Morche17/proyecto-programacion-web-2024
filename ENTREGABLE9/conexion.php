<?php

function conectar() {
    $host = "localhost";
    $user = "Soyadmin";  // Usuario personalizado que hice
    $pass = "password";  // Contraseña de mi usuario
    $bd = "virtualmarket";
    $conn = mysqli_connect($host, $user, $pass, $bd);

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "utf8");
    return $conn;
}

?>
