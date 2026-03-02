<?php
include("includes/conexion.php");

//Registro de Usuarios

if($_SERVER["REQUEST_METHOD"] == "POST"){

$nombre = $_POST ["nombre"];
$apellidos = $_POST ["apellidos"];
$email =  $_POST ["email"];
$password =  $_POST ["password"];

//Encriptación de contraseña con "hash"

$password_hash = password_hash($password, PASSWORD_DEFAULT);

//Insertas en Base de datos

$sql = "INSERT INTO usuarios (nombre, apellidos, email, password_hash)
VALUES('$nombre', '$apellidos', '$email', '$password_hash')";

if($con ->query($sql)){
    echo "Usuario registrado correctamente";
}
else{
    echo "Error: " . $con->error;
}
}
?>
