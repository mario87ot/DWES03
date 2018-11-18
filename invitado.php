<?php
include 'funciones.inc.php';

session_start();
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
   
//if (isset($_SESSION['invitado'])) {
    //Mostramos mensaje con el nombre de invitado y hora de acceso
    echo "<p class='azul' style=text-align:center>Bienvenido " . $_SESSION['invitado'] . "</p>";
    echo "<p class='azul' style=text-align:center>Hora de acceso: " . $_SESSION['hora'] . "</p>";
    //Mostramos menú de invitado
    menuInvitado();
//} 
    ?>
    <footer>Mario David Ordóñez Tercero - Tarea 3 DWES - 2017/2018</footer>
</body>
</html>

<?php
//Si se ha pulsado el botón de Salir, cerramos la sesión
if (isset($_POST['salir'])) {
    header('location: desconectar.php');
}
//Si se ha pulsado el botón tablón, redirigimos a la página tablón.php
if (isset($_POST['tablon'])) {
    header("location: tablon.php");
}



