HOLAAaa


<?php 
session_name("SESION");
session_start();
    if(isset ($_SESSION)){
    echo $_SESSION['nombre'];
}
?>