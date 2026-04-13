<?php

session_start();

//Comprobamos si el usuario a iniciado sesión

if(!isset($_SESSION['id_usuario'])){
    header("Location: login.html");
    exit();
}

$nombreUsuario = $_SESSION['nombre'];

include("includes/conexion.php");

//Consultamos los tuppers del usuario

$idUsuario = $_SESSION['id_usuario'];
$sql= "SELECT * FROM tuppers WHERE id_usuario = $idUsuario ORDER BY fecha_creacion DESC";
$resultado = $conexion->query($sql);

//Construcción de los tuppers

$listaTuppers = "";

if($resultado-> num_rows > 0){
    $listaTuppers .= "<ul>";
    while($tupper = $resultado->fetch_assoc()){
        $nombre = $tupper['nombre'] ?: "Tupper sin nombre";
        $fecha = $tupper['fecha_creacion'];
        $id = $tupper['id_tupper'];
        $listaTuppers .= "<li>$nombre ($fecha) |
         <a href='ver_tupper.php?id_tupper=$id'>Ver</a> |
         <a href='add_alimentos.php?id_tupper=$id'>Añadir alimentos</a> |
         <a href='eliminar_tupper.php?id_tupper=$id'>Eliminar</a>
        </li>";
    }
        $listaTuppers .= "</ul>";
}else{$listaTuppers = "<p>No tienes tuppers creados.</p>";
    }

//Incluimos el HTML

include("mis_tuppers.html");

?>