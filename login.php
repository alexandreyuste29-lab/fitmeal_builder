<?php

//Inicio de sesión y conexión a bbdd

session_start();
include("includes/conexion.php");

if(isset($_POST["login"])){
    $email = $_POST["usuario"];
    $password = $_POST["password"];
    
//Buscar al usuario a través del email

    $sql = "SELET * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $sql);
}

?>