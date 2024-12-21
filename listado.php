<?php 
require("./php/main.php");
require("./inc/header.php");
//--- Extraer y separar palabras ---//
    if(isset($_GET['q'])){
    $q=$_GET['q'];
    $q=explode(" ",$q);
    }

//--- Crear lq ---///
    $lq="";
    foreach($q as $valor){
        $lq.=$valor."+";
    }
    $lq= substr($lq,0,-1);

//--- Declarar query principal ---//
    $query="SELECT SQL_CALC_FOUND_ROWS DISTINCT trabajo.trabajo_titulo, autor.autor_nombre, carrera.carrera_nombre, area_conocimiento.area_nombre 
        FROM trabajo
        INNER JOIN autor ON trabajo.autor_id=autor.autor_id
        INNER JOIN trabajo_detalles ON trabajo.trabajo_id=trabajo_detalles.trabajo_id
        INNER JOIN carrera ON trabajo_detalles.carrera_id=carrera.carrera_id
        INNER JOIN area_conocimiento ON trabajo_detalles.area_id=area_conocimiento.area_id
        WHERE trabajo.trabajo_titulo";

//--- Concatenar a la query cada coincidencia de palabras ---//
    $first_foreach=null;
    foreach($q as $palabra){
        if($first_foreach==true){
            $query.=" OR trabajo_titulo";
        }
        $query.=" LIKE '%$palabra%'"; 
        $first_foreach=true;
    }

//Obtener el nro de la pagina//
    if(isset($_GET['p'])){
        $pagina = $_GET['p'];
    }else{
        $pagina = 1;
    }
//Nombre del listado//
$nombre="listado";
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>UGMA</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,
         user-scalable=no, initial-scale=1, maximum-scale=1, minimun-scale=1">
         <link rel="stylesheet" href="../css/estilos-listado.css">

         <link rel="stylesheet" 
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
         integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
         crossorigin="anonymous" 
         referrerpolicy="no-referrer" />

         <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
        <link rel="stylesheet" href="/Repository-Ugma-main/css/estilos-paginadora.css">
        <link rel="stylesheet" href="/Repository-Ugma-main/css/estilos-listado.css">
    </head>
    <body>
        <main>
        <?php $html = paginadora_trabajos($pagina,2,$query,$nombre,$lq);
            echo $html; ?>
        <?php /*
            <div class="bodylistado">
            </div>
            <p class="coincidencias"><?php echo $total ?> coincidencias</p>

            <?php while($row = $cone->fetch(PDO::FETCH_ASSOC)){ ?>
            <div class="listado-contenedor">
                <div class="listado">
                    <div class="listadoizq">
                        <img src="imagen.jpg" alt="">
                    </div>
                
                    <div class="listadoder">

                        <div class="descripcion">
                            <p>Titulo: <span><?php echo $row['trabajo_titulo'] ?></span></p>
                            <br>
                            <p>Autor: <span><?php echo $row['autor_nombre'] ?></span></p>
                            <p>Carrera: <span><?php echo $row['carrera_nombre'] ?></span></p>
                            <p>Area de investigacion: <span><?php echo $row['area_nombre'] ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?> 
            */?>
            </main>
    </body>