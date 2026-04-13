<?php

//Inicio de sesión y conexión a bbdd

session_start();
include("includes/conexion.php");

if(isset($_POST["login"])){
    $email = $_POST["usuario"];
    $password = $_POST["password"];
    
//Buscar al usuario a través del email

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $sql);

    if(mysqli_num_rows($resultado)==1){

        $usuario = mysqli_fetch_assoc($resultado);

//Verificar contraseña
 
    if(password_verify($password, $usuario ['password_hash'])){

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre']= $usuario['nombre'];

        header("Location: index.php");
        exit();

    }else{echo "Contraseña incorrecta";}

    }else{echo "Usuario no encontrado";}
}

?>