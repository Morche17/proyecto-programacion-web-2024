<?php

function conectar() {
    $host = "localhost";
    $user = "root";
    $pass = "password";
    $bd = "virtualmarket";
    $conn=mysqli_connect($host,$user,$pass,$bd);
    mysqli_select_db($conn,$bd);
    mysqli_set_charset($conn, "utf8");
    return $conn;
}

?>
