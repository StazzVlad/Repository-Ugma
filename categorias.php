<?php 
require("./php/main.php");
require("./inc/header.php");

//Verifica y asigna valor tipo de trabajo//
    if(isset($_GET['tipo']) && $_GET['tipo']!= ""){
        $tipo=$_GET['tipo'];
    }else{
        $tipo=null;
    }

//Verifica y asigna valor facultad//
    if(isset($_GET['facultad'])&& $_GET['facultad']!= ""){
        $facu=$_GET['facultad'];
    } else{
        $facu=null;
    }

//Verifica y asigna valor carrera//
    if(isset($_GET['carrera'])&& $_GET['carrera']!= ""){
        $carrera=$_GET['carrera'];
    }else{
        $carrera=null;
    }

//Declarar la query principal//
    $query="SELECT SQL_CALC_FOUND_ROWS DISTINCT trabajo.trabajo_titulo, autor.autor_nombre, carrera.carrera_nombre, area_conocimiento.area_nombre 
    FROM trabajo
    INNER JOIN autor ON trabajo.autor_id=autor.autor_id
    INNER JOIN trabajo_detalles ON trabajo.trabajo_id=trabajo_detalles.trabajo_id
    INNER JOIN carrera ON trabajo_detalles.carrera_id=carrera.carrera_id
    INNER JOIN facultad ON trabajo_detalles.facultad_id=facultad.facultad_id
    INNER JOIN trabajo_x_tipo_trabajo ON trabajo.trabajo_id=trabajo_x_tipo_trabajo.trabajo_id
    INNER JOIN tipo_trabajo ON trabajo_x_tipo_trabajo.tipo_trabajo_id=tipo_trabajo.tipo_trabajo_id
    INNER JOIN area_conocimiento ON trabajo_detalles.area_id=area_conocimiento.area_id
    WHERE ";

//Concatenar condicion sobre el tipo de trabajo//
    $first_condicion=false;
    if(!is_null($tipo)){
        $query.="trabajo_x_tipo_trabajo.tipo_trabajo_id=$tipo";
        $first_condicion=true;
    }

//Concatenar condicion sobre la facultad//
    if(!is_null($facu)){
        if($first_condicion==true){
            $query.=" AND ";
        }
        $query.="trabajo_detalles.facultad_id=$facu";
        $first_condicion=true;
    }

//Concatenar condicion sobre la carrera//
    if(!is_null($carrera)){
        if($first_condicion==true){
            $query.=" AND ";
        }
        $query.="trabajo_detalles.carrera_id=$carrera";
        $first_condicion=true;
    }


//Conexion y query para TipoTrabajo, Facultades y Carreras//
    $Sfacultades=conexion();
    $Sfacultades=$Sfacultades->query("SELECT facultad_id, facultad_nombre FROM facultad");
    $Stipo=conexion();
    $Stipo=$Stipo->query(("SELECT tipo_trabajo_id, tipo_trabajo_nombre FROM tipo_trabajo"));
    $Scarreras=conexion();
    $Scarreras=$Scarreras->query("SELECT carrera_id,carrera_nombre FROM carrera");

//Obtener el nro de la pagina//
    if(isset($_GET['p'])){
        $pagina = $_GET['p'];
    }else{
        $pagina = 1;
    }
//Nombre del listado//
$nombre="categorias";

//Variables de categorias//


?>


<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>UGMA</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,
         user-scalable=no, initial-scale=1, maximum-scale=1, minimun-scale=1">
         <link rel="stylesheet" href="/Repository-Ugma-main/css/estilos-listado.css">

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
            <div class="bodylistado">
            </div>

            <form>
                <label for="tipo">Tipo de trabajo: </label><br>
                    <select name="tipo" id="tipo">
                        <option value="">Todas</option>
                        <?php while ($row = $Stipo->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['tipo_trabajo_id']; ?>"><?php echo $row['tipo_trabajo_nombre'];?></option>
                        <?php } ?>
                    </select><br><br>

                    <label for="facultad">Facultad: </label><br>
                    <select name="facultad" id="facultad">
                        <option value="">Todas</option>
                        <?php while ($row = $Sfacultades->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['facultad_id']; ?>"><?php echo $row['facultad_nombre'];?></option>
                        <?php } ?>
                    </select><br><br>

                    <label for="carrera">Carrera: </label><br>
                    <select name="carrera" id="carrera">
                        <option value="">Todas</option>
                        <?php while ($row = $Scarreras->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['carrera_id']; ?>"><?php echo $row['carrera_nombre'];?></option>
                        <?php } ?>
                    </select><br><br>

                    <input type="submit">
            </form>
            
            <?php $html = paginadora_trabajos($pagina,2,$query,$nombre,null,$tipo,$facu,$carrera);
            echo $html; 
            ?>


            </main>
    </body>
