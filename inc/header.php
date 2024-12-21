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

    <link rel="stylesheet" href="/Repository-Ugma-main/css/estilos-header.css">

    <title>HEADER</title>
</head>
<body>
    <header>
        <div class="contenedor-header">
                
            <div class="logo">
                <img src="/Repository-Ugma-main/img/UGMA-logo.png" alt="Logo">
                <span>Universidad Noriental <br> "Gran Mariscal de Ayacucho"</span>
            </div>

            <nav>
                <div class="buscador">

                    <form action="/Repository-Ugma-main/listado.php" method="get">
                    <input type="search" name="q" placeholder="Buscar" class="input-primario">
                    <button type="submit" class="btn-primario-amarillo"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <ul class="bar">
                    <li><a href="/Repository-Ugma-main/" class="active"><i class="fa-solid fa-house"></i></a></li>

                    <li><a href="#"><i class="fa-solid fa-book-open"></i> Sobre UGMA</a></li>

                    <li class="has-dropdown">
                        <a href="#"><i class="fa-solid fa-briefcase"></i> Trabajos <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="/Repository-Ugma-main/categorias.php?p=1&tipo=1">Tesis pregrado</a></li>
                            <li><a href="#">Tesis posgrado</a></li>
                            <li><a href="/Repository-Ugma-main/categorias.php?p=1&tipo=2">Pasantías</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <a href="#"><i class="fa-solid fa-landmark"></i> Facultades <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="#">Ingeniería</a></li>
                            <li><a href="#">Derecho</a></li>
                            <li><a href="#">Psicología</a></li>
                            <li><a href="#">FACES</a></li>
                            <li><a href="#">Odontología</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown carreras">
                        <a href="#"><i class="fa-solid fa-graduation-cap"></i> Carreras <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="#"><center>Ingeniería en Sistemas</center></cente></a></li>
                            <li><a href="#"><center>Ingeniería Informática</center></a></li>
                            <li><a href="#"><center>Ingeniería Civil</center></a></li>
                            <li><a href="#"><center>Ingeniería en mantenimiento</center></a></li>
                            <li><a href="#"><center>Contaduría pública</center></a></li>
                            <li><a href="#"><center>Economía</center></a></li>
                            <li><a href="#"><center>Administración</center></a></li>
                            <li><a href="#"><center>Derecho</center></a></li>
                            <li><a href="#"><center>Psicología</center></a></li>
                            <li><a href="#"><center>Odontología</center></a></li>
                        </ul>
                    </li>
                    


                    
                </ul>
            </nav>

            <div class="enlaces-header">
                <div class="ugma">
                    <a href="" class="enlace"><i class="fa-solid fa-chalkboard-user"></i>Estudia con nosotros</a>
                    <button class="btn-secundario-azul"><a href=""><i class="fa-brands fa-facebook only"></i></a></button>
                    <button class="btn-secundario-amarillo"><a href=""><i class="fa-brands fa-instagram only"></i></a></button>
                </div>  


                <div class="usuario">
                    <?php
                        error_reporting(0);
                        $validar = $_SESSION['nombre'];
                        if($validar == null || $validar = ''){
                            echo('
                                <button class="btn-enlace-azul"><a href="./index.php?login&registrarse"><i class="fa-solid fa-user"></i>Registrarse</a></button>
                                <button class="btn-enlace-azul"><a href="./index.php?login"><i class="fa-solid fa-glasses"></i>Acceder</a></button>                                
                            ') ;
                        }
                        else{
                            echo('
                                <button class="btn-enlace-azul"><a href="#"><i class="fa-solid fa-user"></i>Mi Perfil</a></button>  
                                <button class="btn-enlace-azul"><a href="./vistas/logout.php"><i class="fa-solid fa-user"></i>Cerrar Sesion</a></button>  
                            ');               
                        }
                    ?>
                    
                    <!-- <button class="btn-enlace-azul"><a href="login.html"><i class="fa-solid fa-glasses"></i>Acceder</a></button>  -->
                    <button class="btn-primario-azul"><a href=""><i class="fa-solid fa-heart only"></i></a></button>
                </div>

            </div>
        </div>

    </header>

    <main>
        <div class="color-blue"></div>
    </main>
    <?php 
    error_reporting(0);
    $nombre_usuario = $_SESSION['nombre'];
    
    ?>
    

</body>
</html>