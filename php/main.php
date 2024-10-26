<?php

    // Conexion a la base de datos //
    function conexion(){
    $pdo= new PDO('mysql:host=localhost;dbname=Repositorio','root','');
        return $pdo;
    }