<?php
$host = "localhost";
$usuario = "root";
$password = "";
$base_datos = "fitmeal_builder";

$conexion = new mysqli ($host,$usuario, $password, $base_datos);

if ($conexion->connect_error){
    die("Error de conexión: " . $conexion->connect_error);

}

//Para el uso de tildes y caracteres especiales.
$conexion->set_charset("utf8");

?>