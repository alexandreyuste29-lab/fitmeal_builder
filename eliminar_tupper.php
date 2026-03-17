<?php

session_start();

if(!isset($_SESSION['id_usuario'])){
    header("Location: login.html");
    exit();
}

include("includes/conexion.php");

if(!isset($_GET['id_tupper'])){
    die("Tupper no encontrado.");
}

$idTupper = (int)$_GET['id_tupper'];

//Eliminamos alimentos del tupper

$sql1 = "DELETE FROM tuppers_alimentos WHERE id_tupper = $idTupper";
$conexion->query($sql1);

//Eliminamos el tupper

$sql2 = "DELETE FROM tuppers WHERE id_tupper=$idTupper";
$conexion->query($sql2);

header("Location: mis_tuppers.php");
exit();

?>