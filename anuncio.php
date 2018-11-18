<?php
include 'funciones.inc.php';
session_start();

/* Si se intenta acceder a esta página sin estar logueado,se redirige automáticamente
  a la página de login para que inicie sesión */
if (!isset($_SESSION['usuario'])) {
    header("location: login.php");
    die();
}
$usuario = $_SESSION['usuario'];
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
    bienvenida();
    menuVoluntario();
    formAnuncio();
    ?>
    <br>
    <p class='centro'><a href="voluntario.php">Volver</a></p>
    <footer>Mario David Ordóñez Tercero - Tarea 3 DWES - 2017/2018</footer>
</body>
</html>

<?php
//Si se pulsa el botón Insertar del formulario de creación de anuncio
if (isset($_POST['insertar'])) {
    //Abrimos conexión con la base de datos
    $conexion = abrirConexion();
    //Almacenamos los datos introducidos en el formulario
    $privado = $_POST['opcion'];
    $contenido = $_POST['contenido'];
    //Almacenamos la fecha y el id (el id es autoincrementable)
    $fecha = date("Y-m-d");
    $id = 0;
    //Validamos los campos del formulario, si todo es correcto, se almacena el anuncio
    validarCamposAnuncio($conexion, $id, $usuario, $contenido, $fecha, $privado);
}
?>
<br>
