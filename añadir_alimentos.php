<?php

session_start();

//Comprobamos si el usuario a iniciado sesión

if(!isset($_SESSION['id_usuario'])){
    header("Location: login.html");
    exit();
}

$nombreUsuario = $_SESSION['nombre'];

include("includes/conexion.php");

//Comprobamos si se recibe el id del tupper

if(!isset($_GET['id_tupper'])){
    die("Tupper no encontrado.");
}

//Aseguramos que el valor sea un número entero

$idTupper = (int)$_GET['id_tupper'];

//Procesar el formulario si se envió

if(isset($_POST['añadir_alimentos'])){
    if(isset($_POST['alimentos']) && is_array($_POST['alimentos'])){
        foreach($_POST['alimentos'] as $idAlimento){
            $idAlimento = (int)$idAlimento;
            $sqlInsert = "INSERT INTO tuppers_alimentos (id_tupper, id_alimento) 
            VALUES ($idTupper, $idAlimento)";
            $conexion->query($sqlInsert);
        }
        $mensaje = "Alimentos añadidos correctamente.";
    }else{$mensaje = "No seleccionaste ningún alimento.";}
}

//Obtenemos la lista de alimentos de la base de datos

$sqlAlimentos = "SELECT * FROM alimentos ORDER BY categoria, nombre ASC";
$resultAlimentos = $conexion->query($sqlAlimentos);

$listaAlimentos = "";
$categoriaActual = "";

if($resultAlimentos->num_rows > 0){
    while($alimento = $resultAlimentos->fetch_assoc()){
        //Que se muestre si cambia la categoría
        if($categoriaActual != $alimento['categoria']){
            $categoriaActual = $alimento['categoria'];
            $listaAlimentos .= "<h3>$categoriaActual</h3>";
        }

        $id = $alimento['id_alimento'];
        $nombre = $alimento ['nombre'];
        $listaAlimentos .= "<li><input type='checkbox' name='alimentos[]' value='$id'>$nombre
        </li>";
    }
}

//Incluimos HTML

include("añadir_alimentos.html");
?>