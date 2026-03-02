<?php
$host = "localhost";
$usuario = "root";
$password = "";
$base_datos = "fitmeal_builder";

$con = new mysqli ($host,$usuario, $password, $base_datos);

if ($con->connect_error){
    die("Error de conexión: " . $con->connect_error);

}

//Para el uso de tildes y caracteres especiales.
$con->set_charset("utf8");

?>