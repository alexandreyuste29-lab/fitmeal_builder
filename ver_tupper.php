<?php 

session_start();

//Comprobamos si el usuario ha iniciado sesión

if(!isset($_SESSION['id_usuario'])){
    header("Location: login.html");
    exit();
}

//Guardamos el nombre del usuario para el HTML
$nombreUsuario = $_SESSION['nombre'];

//Conexión a la base de datos
include("includes/conexion.php");

//Comprobamos si llega el id del tupper

if(!isset($_GET['id_tupper'])){
    die("Tupper no encontrado.");
}

//Aseguramos que el id sea un número entero
$idTupper = (int)$_GET['id_tupper'];

//Consulta para obtener los alimentos del tupper junto con sus calorías

$sql = "SELECT alimentos.nombre, alimentos.calorias, alimentos.proteinas, alimentos.carbohidratos, alimentos.grasas
FROM tuppers_alimentos JOIN alimentos 
ON tuppers_alimentos.id_alimento =alimentos.id_alimento 
WHERE tuppers_alimentos.id_tupper = $idTupper";

$resultado = $conexion->query($sql);

//Inicializamos variables para el HTML y el total de calorías

$totalCalorias = 0;
$totalProteinas = 0;
$totalCarbohidratos = 0;
$totalgrasas = 0;

$listaAlimentos="";


//Si hay alimentos, construimos la lista HTML
if($resultado->num_rows>0){
    while($fila = $resultado->fetch_assoc()){
    
        //Sumas nutricionales

    $totalCalorias += $fila['calorias'];
    $totalProteinas += $fila['proteinas'];
    $totalCarbohidratos += $fila['carbohidratos'];
    $totalGrasas += $fila['grasas'];

    $nombre 0 $fila['nombre'];
    $listaAlimentos .= "<li>$nombre</li>";

}else{$listaAlimentos = "<p>Este tupper no tiene alimentos.</p>"}

include("ver_tupper.html");

?>