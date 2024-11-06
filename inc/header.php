<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--    Iconos      -->
    <link rel="stylesheet" 
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
         integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
         crossorigin="anonymous" 
         referrerpolicy="no-referrer" 
    />

    <link rel="stylesheet" href="./css/estilos-header.css">

    <title>HEADER</title>
</head>
<body>
    <header>
        <div class="contenedor">
                
            <div class="logo">
                <img src="./img/UGMA-logo.png" alt="Logo">
                <span>Universidad Noriental <br> "Gran Mariscal de Ayacucho"</span>
            </div>

            <nav>
                <div class="buscador">
                    <input type="search" placeholder="Buscar">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

                <ul class="bar">
                    <li><a href="#" class="active"><i class="fa-solid fa-house"></i></a></li>

                    <li><a href="#"><i class="fa-solid fa-book-open"></i> Sobre UGMA</a></li>

                    <li class="has-dropdown">
                        <a href="#"><i class="fa-solid fa-briefcase"></i> Trabajos <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="#">Tesis pregrado</a></li>
                            <li><a href="#">Tesis posgrado</a></li>
                            <li><a href="#">Pasantías</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <a href="#"><i class="fa-solid fa-landmark"></i> Facultades <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="#">Ingeniería</a></li>
                            <li><a href="#">Derecho</a></li>
                            <li><a href="#">Psicología</a></li>
                            <li><a href="#">FACES</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <a href="#"><i class="fa-solid fa-graduation-cap"></i> Carreras <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="#">Sistemas</a></li>
                            <li><a href="#">Informática</a></li>
                            <li><a href="#">Civil</a></li>
                            <li><a href="">Administración</a></li>
                            <li><a href="">Derecho</a></li>
                            <li><a href="">Psicología</a></li>
                        </ul>
                    </li>


                    
                </ul>
            </nav>

            <div class="enlaces-header">
                <div class="ugma">
                    <button><a href=""><i class="fa-solid fa-chalkboard-user"></i>Estudia con nosotros</a></button>
                    <button><a href=""><i class="fa-brands fa-facebook only"></i></a></button>
                    <button><a href=""><i class="fa-brands fa-instagram only"></i></a></button>
                </div>  

                <div class="usuario">
                    <?php
                        error_reporting(0);
                        $validar = $_SESSION['nombre'];
                        if($validar == null || $validar = ''){
                            echo('
                                <button><a href="./index.php?login&registrarse"> <i class="fa-solid fa-user"></i>Registrarse</a></button>
                                <button><a href="./index.php?login"><i class="fa-solid fa-glasses"></i>Acceder</a></button>   
                            ') ;
                        }
                        else{
                            echo('
                                <button><a href=""><i class="fa-solid fa-user"></i>Mi Perfil</a></button>  
                                <button><a href="./vistas/logout.php"><i class="fa-solid fa-user"></i>Cerrar Sesion</a></button>  
                            ');               
                        }
                    ?>
                    <!--  Oculto
                    <button><a href=""> <i class="fa-solid fa-user"></i>Registrarse</a></button>
                    <button><a href=""><i class="fa-solid fa-glasses"></i>Acceder</a></button> 
                    -->   
                    <button><a href="" ><i class="fa-solid fa-heart only"></i></a></button>
                </div>
            </div>
        </div>

    </header>
    <?php 
    error_reporting(0);
    $nombre_usuario = $_SESSION['nombre'];
    echo "<p style=\"position:absolute;top:15% \">Hola '$nombre_usuario'</p>";
    
    ?>
    
</body>
</html>