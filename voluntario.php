<?php
session_start();
include 'funciones.inc.php';
/* Si se intenta acceder a esta página sin estar logueado,se redirige automáticamente
  a la página de login para que inicie sesión */
if (!isset($_SESSION['usuario'])) {
    header("location: login.php");
    die();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Tablón de anuncios</title>
    </head>
    <?php
    if (isset($_COOKIE['colorfondo'])) {
        //Ponemos el color de fondo en función del valor que contenga la cookie
        colorFondo($_COOKIE['colorfondo']);
    }
    //Mostramos mensaje con el nombre de usuario y hora de acceso
    bienvenida();
    menuVoluntario();

    //Si se pulsa la opción Crear anuncio del menú, redirigimos a la página anuncio.php
    if (isset($_POST['anuncio'])) {
        header("location: anuncio.php");
    }
    //Si se pulsa la opción Tablón del menú, redirigimos a la página tablon.php
    if (isset($_POST['tablon'])) {
        header("location: tablon.php");
    }
    //Si se pulsa la opción Preferencias del menú, redirigimos a la página preferencias.php
    if (isset($_POST['preferencias'])) {
        header("location: preferencias.php");
    }    
    //Si se pulsa la opción Cerrar sesión del menú, redirigimos a la página desconectar.php para cerrar la sesión
    if (isset($_POST['cerrarsesion'])) {
        header("location: desconectar.php");
    }
    ?>
    <footer>Mario David Ordóñez Tercero - Tarea 3 DWES - 2017/2018</footer>
</body>
</html>
