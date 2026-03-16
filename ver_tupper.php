<?php 

session_start();

//Comprobamos si el usuario ha iniciado sesión

if(!isset($_SESSION['id_usuario'])){
    header("Location: login.html");
    exit();
}
$nombreUsuario = $_SESSION['nombre'];

include("includes/conexion.php");

//Comprobamos si llega el id del tupper

if(!isset($_GET['id_tupper'])){
    die("Tupper no encontrado.");
}

$idTupper = (int)$_GET['id_tupper'];

//Consulta para obtener los alimentos del tupper

$sql = "SELECT alimentos.nombre, alimentos.calorias
FROM tuppers_alimentos JOIN alimentos 
ON tuppers_alimentos.id_alimento =alimentos.id_alimento 
WHERE tuppers_alimentos.id_tupper = $idTupper";

$resultado = $conexion->query($sql);

//Construimos la lista

$listaAlimentos="";
$totalCalorias = 0;

if($resultado->num_rows>0){

$listaAlimentos .= "<ul>";

while($fila = $resultado->fetch_assoc()){
    $nombre = $fila['nombre'];
    $calorias = $fila['calorias'];
    $totalCalorias += $calorias;
    $listaAlimentos .= "<li>$nombre - $calorias kcal</li>";
}

$listaAlimentos .= "</ul>";
$listaAlimentos .= "<p><strong>Calorías totales del tupper: $totalCalorias kcal </strong></p>";

}else{$listaAlimentos = "<p>Este tupper no tiene alimentos todavía.</p>";}

include("ver_tupper.html");

?>