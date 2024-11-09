<?php require("./inc/session_start.php");?>

<!DOCTYPE html>
<html lang="es">
    <head>
    </head>
    <body>
    <?php 
    //include("./php/new_trabajo.php");

    if(isset($_GET['login'])){
        include("./vistas/login.php");
    }else{
        include("./inc/header.php");
        
    }


/*
        //---Logica para manejo de vistas---//
    //-Entrar a home si no esta en una pagina definida
    if(!isset($_GET['vista']) || $_GET['vista']==""){
        $_GET['vista']="inicio";
    }

    //-Si esta en una pagina distinta al login y 404: Agregar nadbar-//
    if(is_file("./vistas/".$_GET['vista'].".php") && $_GET['vista']!="login" && $_GET['vista']!="404"){
        include("./inc/header.php");
        include("./vistas/".$_GET['vista'].".php"); 
    }else{
        if($_GET['vista']=="login"){
            include("./vistas/login.php");
        }else{
            include("./vistas/404.php");
        }
    } 
    */
    ?>
    </body>