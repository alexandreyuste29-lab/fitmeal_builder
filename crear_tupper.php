<?php 

session_start();

//Comprobamos si el usuario ha iniciado sesión

if(!isset($_SESSION['id_usuario'])){
    header("Location: login.html");
    exit();
}

//Guardamos variables para el HTML

$nombreUsuario = $_SESSION['nombre'];

//Inicializamos mendaje vacío

$mensaje ="";

//Archivo de conexión

include("includes/conexion.php");

//Comprobamos si se ha enviado el formulario

if(isset($_POST['crear_tupper'])){
    $idUsuario = $_SESSION['id_usuario'];
    $nombreTupper = $_POST['nombre_tupper']; //Para que el usuario pueda poner un nombre a su tupper

//Insertar tuppers en la base de datos
$sql = "INSERT INTO tuppers (id_usuario, nombre, fecha_creacion) 
        VALUES ('$idUsuario', '$nombreTupper', NOW())";

if($conexion->query($sql)){

//Obtenemos ID del tupper que acabamos de crear

    $idTupper = $conexion->insert_id;

    //Redirección a "Añadir alimentos"

    header("Location: add_alimentos.php?id_tupper=$idTupper&mensaje=creado");

    exit();

}else{$mensaje = "Error al crear el tupper: " . $conexion->error;}
}

//Incluir el HTML del formulario

include("Crear_tupper.html");

?>