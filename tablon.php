<?php
session_start();
include "funciones.inc.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Tablón de anuncios</title>
</head>
<?php
    if (isset($_COOKIE['colorfondo'])) {
        //Ponemos el color de fondo en función del valor que contenga la cookie
        colorFondo($_COOKIE['colorfondo']);
    }
    
    //Si ha accedido un usuario invitado, mostramos sólo los anuncios públicos
    if (isset($_SESSION['invitado'])) {
        $conexion = abrirConexion();
         //Mostramos mensaje con el nombre de invitado y hora de acceso
        echo "<p class='azul' style=text-align:center>Bienvenido " . $_SESSION['invitado'] . "</p>";
        echo "<p class='azul' style=text-align:center>Hora de acceso: " . date("H:i:s") . "</p>";
        menuInvitado();
        mostrarAnunciosPublicos($conexion);
        echo "<p><a href='invitado.php'>Volver</a></p>";
    } else
    //Si ha accedido un usuario logueado mostramos tanto los anuncios públicos como los privados
    if (isset($_SESSION['usuario'])) {
        $conexion = abrirConexion();
        bienvenida();
        menuVoluntario();
        mostrarAnuncios($conexion);
        echo "<p><a href='voluntario.php'>Volver</a></p>";
    } else {
        /* Si se intenta acceder a esta página sin estar logueado,se redirige automáticamente
          a la página de login para que inicie sesión */
        header("location: login.php");
        die();
    }
    ?>
    <footer>Mario David Ordóñez Tercero - Tarea 3 DWES - 2017/2018</footer>
</body>

</html>
