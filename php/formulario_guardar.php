<?php

    require_once("main.php");


    //---Guardamos los datos---//
    $titulo=limpiar_cadena($_POST['titulo']);
    $autor=limpiar_cadena($_POST['autor']);
    $nota=limpiar_cadena($_POST['nota']);
    $resumen=limpiar_cadena($_POST['resumen']);

    $sede=$_POST['sede'];
    $facultad=$_POST['facultad'];
    $carrera=$_POST['carrera'];
    $area=$_POST['area'];
    $linea=$_POST['linea'];
    $fecha=$_POST['fecha'];
    $trabajo=$_FILES['trabajo']['tmp_name'];

    //---Filtro para el foreach que verifica la integridad de los datos--//
    $filtros=[
        "$titulo" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,250}",
        "$autor" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",
        "$nota" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",
        "$resumen" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,5000}"
    ];

    //---Verificando campos obligatorios ---//
    if($titulo==""||$autor==""||$nota==""||$resumen==""){
        echo'
            <div>
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /*== Verificando integridad de los datos ==*/
    foreach($filtros as $variable=>$filtro){
        if(verificar_datos($filtro,$variable)){
            echo '
                <div>
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    "'.$variable.'" no coincide con el formato solicitado para ese campo
                </div>
            ';
            exit();
        }
    }

    echo "Formulario subido con exito";


?>
