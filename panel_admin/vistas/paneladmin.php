<?php
    error_reporting(0);
    $validar = $_SESSION['nombre'];
    if($validar == null || $validar ==""){
        header("Location: ../index.php");
    }
    
?>
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

    <link rel="stylesheet" href="./css/estilos-panel.css">

    <title>Panel administrador</title>
</head>

<body>

    <!--=== 👀 #SIDEBAR
            Seccion de barra lateral desplegable que se reduce al presionar => (.interruptor-sidebar)
            
            Contiene 3 elementos principales:
                1)  Titulo de la pagina: => (".titulo-pagina") 
                    lo que dice "Administrador"

                2)  Usuario: => (".usuario") 
                    incluye la FOTO del usuario, su CARGO y/o FACULTAD que administra (sub-cargo) 

                3)  Opciones del menu (Menu lateral): => (side-menu)
                        Incluye todos los elementos seleccionables del menu que no estan relacionados con el usuario:
                            Panel 
                            JEFE DE FACULTAD: Gestionar trabajos / Gestionar lineas de investigacion / Gestionar areas de conocimiento
                            ADMINISTRADOR: Gestionar usuarios / Gestionar facultades / Gestionar carreras 

                        y sus respectivos sepadores (elementos li con la clase divider)
    ===-->
        <section id="sidebar">
            <!-- 1) Titulo de la pagina -->
                <h1 class="titulo-pagina">Administrador</h1>

            <!-- 2) Usuario -->
                <div class="usuario">
                    <img src="./img/coneja secuetradora.JPG" alt="imagen admin">

                    <div class="cargo">
                        <span>Cargo:</span><p>
                            <?php
                                $cargo_usuario = $_SESSION['cargo'];
                                echo $cargo_usuario;

                            ?>
                        </p>
                    </div>

                    <div class="sub-cargo">
                        <span>Facultad:</span><p>
                            <?php
                                $facultad_usuario = $_SESSION['facultad'];
                                echo $facultad_usuario;

                            ?>
                        </p>
                    </div>
                </div>

            <!-- 3) Opciones del menu 
                ✔ La clase .active señala en que posicion de la pagina se encuentra, es la que hace que el elemento sea azul, para indicarle al usuario 
                    que se encuentra en PANEL (o en GESTIONAR...{trabajos, lineas,areas,usuarios,facultades,carreras})
                
                ✔ La clase .divider son elementos li que separan al menu VISUALMENTE en dos categorias 
                    (jefe de facultad y administrador)
                
                ✔ La clase .side-dropdown engloba a los elementos li desplegables y en conjunto con js permite que pueda mostrase u ocultarse
            -->
            <ul class="side-menu">
                <li><a href="#" class="active"><i class="fa-solid fa-table-columns icon"></i>Panel</a></li>

                <!--separador: JEFE FACULTAD -->
                    <li class="divider" data-text="jefe de facultad"></li> <!--li separador-->
                            
                    <li>
                        <a href="#"><i class="fa-solid fa-briefcase icon"></i>Gestionar trabajos<i class="fa-solid fa-chevron-down icon-derecho"></i></i></a>

                        <ul class="side-dropdown">
                            <?php 
                                error_reporting(0);
                                $cargo_usuario = $_SESSION['rol_id'];
                                
                                switch($cargo_usuario){
                                    case 1:
                                        echo '<li><a href="#"> Tesis de pregrado</a></li>';
                                        break;
                                    case 2:
                                        echo '<li><a href="#"> Tesis de posgrado</a></li>';
                                        break;
                                    case 3:
                                        echo '<li><a href="#"> Pasantías</a></li>';
                                        break;
                                    default:
                                        echo '
                                        <li><a href="#"> Tesis de pregrado</a></li>
                                        <li><a href="#"> Tesis de posgrado</a></li>
                                        <li><a href="#"> Pasantías</a></li>
                                        ';

                                }
                            
                            ?>
                            
                        </ul>
                    </li>

                    <li><a href="#"><i class="fa-solid fa-glasses icon"></i> Gestionar lineas de investigación</a></li>

                    <li><a href="#"><i class="fa-solid fa-book icon"></i> Gestionar áreas de conocimiento</a></li>
                   
                
                <!--separador: ADMINISTRADOR -->
                  
                    <li class="divider" data-text="administrador"></li> <!-- li separador-->

                    <li><a href="#"><i class="fa-solid fa-user icon"></i></i> Gestionar usuarios</a></li>

                    <li>
                        <a href="#"><i class="fa-solid fa-landmark icon"></i> Gestionar facultades</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa-solid fa-graduation-cap icon"></i> Gestionar carreras</a>
                    </li>
                
            </ul>
        </section>

    <!--=== 👀 #CONTENIDO: 
        Lo que no pertenece a la barra lateral 
    ===-->
        <section id="contenido">

            <!-- #nav 
                Toda la barra que se encuentra por encima-->
            <nav>
                <!-- boton interruptor: el que despliega el side-menu -->
                <i class="fa-solid fa-bars btn-menu interruptor-sidebar"></i>

                <!-- barra de busqueda -->
                    <form action="#">
                        <div class="form-grupo">
                            <input type="text" placeholder="Buscar...">
                            <i class="fa-solid fa-magnifying-glass icon"></i>
                        </div>
                    </form>
        
                <span class="divider"></span>

                <!-- Perfil para configuracion de usuario -->
                    <div class="perfil">
                        <img src="img/coneja secuetradora.JPG" alt="">
                        <ul class="perfil-link">
                            <li><a href="#"><i class="fa-solid fa-pen-to-square icon"></i>Editar perfil</a></i></li>
                            <li><a href="./vistas/logout.php"><i class="fa-solid fa-right-from-bracket icon"></i> Salir</a></i></li>
                        </ul>
                    </div>
            </nav>

        <!-- 👀 #main: 
            Todo lo que cambia en cada pagina que pertenezca al panel de administracion 
                BIENVENIDO / INDICADOR DE PAGINA / INFO-DATA (cuadritos de porcentajes): pregrado, posgrado, pasantias
        -->
            <main>
                <?php
                    $nombre_usuario = $_SESSION['nombre'];
                    echo '<h1 class="bienvenido">Bienvenido, '.$nombre_usuario.'</h1>';
                ?>

                <!-- INDICADOR PAGINA
                    Para indicarle al usuario donde se encuentra dentro de las categorias que son desplegables u opciones con formularios que puedan cambiar

                    ejemplo: GESTIONAR TRABAJOS / pasantias / subir pasantia
                             GESTIONAR CARRERA / agregar carrera
                             PERFIL / cambio de contraseña
                -->
                <ul class="indicador-pagina">
                    <li><a href="#">Inicio</a></li>

                    <li class="divider">/</li>

                    <li><a href="#" class="active">Panel principal</a></li>
                </ul>

                
                <!-- INFO-DATA
                    Numeros que indican los trabajos que se hallan en la base de datos
                        ✔ Cada clase .card es un cuadrito

                        ✔ Los H2 señalan la cantidad de trabajos que hay por categoria en la base de datos 
                            (pregrado, posgrado, pasantias)

                        ✔ los span con la clase .progreso son las barras azules que indican que porcentaje es esa categoria, 
                            para modificar su largo se actualiza el valor del atributo "data-value"

                        ✔ label es el porcentaje
                -->
                <div class="info-data">

                    <!-- trabajos -->
                    <div class="card">
                        <div class="porcentajes">
                            <div>
                                <h2><!-- 1500 -->
                                    <?php
                                        require_once("./php/contarTrabajos.php");
                                        echo "$totalTrabajos";  
                                    ?>
                                </h2>
                                <p>Trabajos</p>
                            </div>
                            <i class="fa-solid fa-briefcase icon"></i>
                        </div>

                        <span class="progreso" data-value="100%"></span>
                        <span class="label">100%</span>
                    </div>
                    
                    <!-- pregrado -->
                    <div class="card"> 
                        <div class="porcentajes">
                            <div>
                                <h2><!--900-->
                                <?php
                                        require_once("./php/contarTrabajos.php");
                                        echo "$totalPregrado";  
                                ?>

                                </h2>
                                <p>Tesis de pregrado</p>
                            </div>
                            <i class="fa-solid fa-briefcase icon"></i>
                        </div>
                            
                        <?php
                            require_once("./php/contarTrabajos.php");
                            $porcentaje = $totalPregrado*100/$totalTrabajos;
                            $porcentaje = round($porcentaje,2);
                            echo '
                                <span class="progreso" data-value='."$porcentaje%".'></span>

                                <span class="label">'."$porcentaje%".'</span>
                            ';  
                        
                        ?>
                    </div>
                    
                    <!-- posgrado -->
                    <div class="card">
                        <div class="porcentajes">
                            <div>
                                <h2><!--900-->
                                <?php
                                        require_once("./php/contarTrabajos.php");
                                        echo "$totalPosgrado";  
                                ?>

                                </h2>
                                <p>Tesis de posgrado</p>
                            </div>
                            <i class="fa-solid fa-briefcase icon"></i>
                        </div>
                        
                        <?php
                            require_once("./php/contarTrabajos.php");
                            $porcentaje = $totalPosgrado*100/$totalTrabajos;
                            $porcentaje = round($porcentaje,2);
                            echo '
                                <span class="progreso" data-value='."$porcentaje%".'></span>

                                <span class="label">'."$porcentaje%".'</span>
                            ';  
                        
                        ?>

                    </div>
                    
                     <!-- pasantias -->
                    <div class="card">
                        <div class="porcentajes">
                            <div>
                                <h2>
                                <?php
                                        require_once("./php/contarTrabajos.php");
                                        echo "$totalPasantia";  
                                ?>
                                </h2>
                                <p>Pasantías</p>
                            </div>
                            <i class="fa-solid fa-briefcase icon"></i>
                        </div>

                        <?php
                            require_once("./php/contarTrabajos.php");
                            $porcentaje = $totalPasantia*100/$totalTrabajos;
                            $porcentaje = round($porcentaje,2);
                            echo '
                                <span class="progreso" data-value='."$porcentaje%".'></span>

                                <span class="label">'."$porcentaje%".'</span>
                            ';  
                        
                        ?>

                    </div>

                </div>
            </main>
    </section>

</body>

<footer></footer>
<script src="js/admin-script.js"></script>
</body>
</html>