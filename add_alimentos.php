<?php

session_start();

//Comprobamos si el usuario a iniciado sesión

if(!isset($_SESSION['id_usuario'])){
    header("Location: login.html");
    exit();
}

$nombreUsuario = $_SESSION['nombre'];

include("includes/conexion.php");

//Mensaje tupper creado

$mensaje = "";

if(isset($_GET['mensaje'])&& $_GET['mensaje'] == "creado"){
    $mensaje = "Tupper creado correctamente";
}

//Comprobamos si se recibe el id del tupper

if(!isset($_GET['id_tupper'])){
    die("Tupper no encontrado.");
}

//Aseguramos que el valor sea un número entero

$idTupper = (int)$_GET['id_tupper'];

//Procesar el formulario si se envió

if(isset($_POST['añadir_alimentos'])){
    if(isset($_POST['alimentos']) && is_array($_POST['alimentos'])){

        //Contar si se añadió algún alimento

        $añadidos = 0; 

        foreach($_POST['alimentos'] as $idAlimento){
            $idAlimento = (int)$idAlimento;

            //Comprobamos si ya existe

            $sqlComprobacion = "SELECT * FROM tuppers_alimentos
            WHERE id_tupper = $idTupper AND id_alimento = $idAlimento";

            $resultadoComprobacion = $conexion->query($sqlComprobacion);

            if($resultadoComprobacion->num_rows == 0){
                //Insertamos solo si no existe
                $sqlInsert = "INSERT INTO tuppers_alimentos (id_tupper, id_alimento) 
                VALUES ($idTupper, $idAlimento)";
                $conexion->query($sqlInsert);

                //Suma si se añade

                $añadidos++;
            }
        }

        if($añadidos > 0){
        $mensaje = "Alimentos añadidos correctamente.";
       }else{
        $mensaje = "Los alimentos ya estaban añadidos.";}
       }
       else{
        $mensaje = "No seleccionaste ningún alimento.";}
}



//Obtenemos la lista de alimentos de la base de datos

$sqlAlimentos = "SELECT DISTINCT nombre, categoria, imagen, id_alimento 
FROM alimentos 
GROUP BY nombre, categoria, imagen
ORDER BY categoria, nombre ASC";

$resultAlimentos = $conexion->query($sqlAlimentos);
$listaAlimentos = "";
$categoriaActual = "";

if($resultAlimentos->num_rows > 0){

    $listaAlimentos = "<div class='categorias'>";

    while($alimento = $resultAlimentos->fetch_assoc()){
        //Que se muestre si cambia la categoría
        if($categoriaActual != $alimento['categoria']){
            if($categoriaActual !=""){
            $listaAlimentos .= "</ul></div></div>";
        }

        $categoriaActual = $alimento['categoria'];

        //Abrimos categoria y añadimos acordeon
         
        $listaAlimentos .= "<div class='categoria-box'>";
        $listaAlimentos .= "<button class='acordeon-btn'>$categoriaActual</button>";
        $listaAlimentos .= "<div class='panel'><ul>";
    }

        $id = $alimento['id_alimento'];
        $nombre = $alimento['nombre'];
        
        //Si la imagen es null usa default

        $imagen = $alimento['imagen'] ? $alimento['imagen'] : 'default.jpg';
        $listaAlimentos .= "
        <li>
        <img src='assets/$imagen' width='50'>
        <input type='checkbox' name='alimentos[]' value='$id'>$nombre
        </li>";
    }
    $listaAlimentos .= "</ul></div></div>";
    $listaAlimentos .= "</div>";
}

//Incluimos HTML

include("add_alimentos.html");
?>