<?php 

session_start();

//Comprobar si el usuario ha iniciado sesión. Si no, redirige al login

if(!isset($_SESSION['id_usuario'])){
    header("Location: login.html");
    exit();
}

//Guardar nombre del usuaario en variable para el Html

$nombreUsuario = $_SESSION['nombre'];

//Llamada al Html

include("panel.html");
?>