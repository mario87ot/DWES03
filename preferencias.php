<?php
session_start();
include 'funciones.inc.php';
/* Si se intenta acceder a esta página sin estar logueado,se redirige automáticamente
  a la página de login para que inicie sesión */
if (!isset($_SESSION['usuario'])) {
    header("location: login.php");
    die();
}

//Si se ha pulsado en Establecer color de fondo
if (isset($_POST['establecer'])) {
    //Creamos una cookie que almacene el color seleccionado
    setcookie("colorfondo", $_POST['color'], time() + 3600, "/");
    $_COOKIE['colorfondo'] = $_POST['color'];
}
//Si se ha pulsado la opción Restablecer preferencias
if (isset($_POST['eliminacookie'])) {
    if (isset($_COOKIE["colorfondo"])) {
    //Destruimos la cookie y se restablecerán las prefencias por defecto
    setcookie("colorfondo", $_COOKIE['colorfondo'], time() - 1, "/");
        header("Location: preferencias.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Tablón de anuncios</title>
</head>
<?php
    //Si la cookie que almacena el color de fondo está definida
    if (isset($_COOKIE['colorfondo'])) {
        //Ponemos el color de fondo en función del valor que contenga la cookie
        colorFondo($_COOKIE['colorfondo']);
    }
    bienvenida();
    menuVoluntario();
    formPreferencias();
    ?>

<p><a href="voluntario.php">Volver</a></p>
<footer>Mario David Ordóñez Tercero - Tarea 3 DWES - 2017/2018</footer>
</body>

</html>
