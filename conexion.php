<?php
$servidor = "localhost";
$usuario = "root";
$clave = ""; // Si tienes contraseña, agrégala aquí
$base_datos = "kd_electronics";

$conn = new mysqli($servidor, $usuario, $clave, $base_datos);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>

