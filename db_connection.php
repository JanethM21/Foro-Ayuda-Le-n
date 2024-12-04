<?php
$host = 'localhost'; // Cambia esto si tu base de datos está en otro servidor
$db = 'ayuda_leon'; // Nombre de tu base de datos
$user = 'root'; // Tu usuario de MySQL
$pass = ''; // Tu contraseña de MySQL

// Crear conexión
$mysqli = new mysqli($host, $user, $pass, $db);

// Comprobar conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8
$mysqli->set_charset("utf8");
?>