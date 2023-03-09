<?php
ini_set('default_charset', 'UTF-8');

$servername = "localhost";
$username = "jesucristo";
$password = "password";
$dbname = "capycontent";

// Crear conexión
$conexion = mysqli_connect($servername, $username, $password, $dbname);

// Comprobar la conexión
if (!$conexion) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8mb4");
?>
