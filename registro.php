<!DOCTYPE html>
<?php
include "funciones.inc.php";
?>
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
    menu();
    ?>
    <?php
    //Si se ha pulsado el botón guardar del formulario de registro
    if (isset($_POST['guardar'])) {
        //Almacenamos los datos introducidos en el formulario
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $email = $_POST['email'];
        //abrimos conexión con la base de datos
        $conexion = abrirConexion();
        //Validamos los campos, si todo va bien, se procede al registo del usuario
        validarCamposRegistro($conexion, $login, $password, $password2, $email);
        
    }
    //Si se pulsa el botón volver, redirigimos a la página de inicio
    if (isset($_POST['volver'])) {
        header("location: index.php");
    }
    ?>
    <p>RELLENE SUS DATOS</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <?php
        formRegistro();
        ?>
    </form>
    
    <?php
   
    
    ?>
    <footer>Mario David Ordóñez Tercero - Tarea 3 DWES - 2017/2018</footer>
</body>
</html>



