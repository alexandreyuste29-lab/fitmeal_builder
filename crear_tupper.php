<?php 

session_start();

//Comprobamos si el usuario ha iniciado sesión

if(!isset($_SESSION['id_usuario'])){
    header("Location: login.html");
    exit();
}

//Guardamos variables para el HTML

$nombreUsuario = $_SESSION['nombre'];

//Archivo de conexión

include("includes/conexion.php");

//Comprobamos si se ha enviado el formulario

if(isset($_POST['crear_tupper'])){
    $idUsuario = $_SESSION['id_usuario'];
    $nombreTupper = NULL; //Ya que los tuppers no tienen nombre específico

//Insertar tuppers en la base de datos
$sql = "INSERT INTO tuppers (id_usuario, nombre, fecha_creacion) 
        VALUES ('$idUsuario', '$nombreTupper', NOW())";

if($conexion->query($sql)){
    $mensaje = "Tupper creado correctamente";
}else{$mensaje = "Error al crear el tupper: " . $conexion->error;}
}

//Incluir el HTML del formulario

include("Crear_tupper.html");

?>