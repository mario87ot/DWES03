<?php
    include 'funciones.inc.php';
    menu();
    // Si se ha pulsado el botón Iniciar
    if (isset($_POST['iniciar'])) {
        //Guardamos el login y password enviados por post
        $login = $_POST['login'];
        $password = $_POST['password'];
        //Si se ha dejado algún campo del formulario vacío, mostramos un mensaje de error
        if (empty($login) || empty($password)) 
            echo "<p class='rojo centro'>*Introduce un nombre de usuario y una contraseña</p>";
        //Si se ha introducido un login y una contraseña
        else { 
            //Abrimos la conexión con la base de datos
            $conexion = abrirConexion();
                
            //Guardamos un array con los datos que corresponden al usuario con el login introducido
            $usuario=getUser($login,$conexion);
            //Guardamos la contraseña del usuario almacenada en la BD
            $claveBD = $usuario['password'];
            
            // Comprobamos si la contraseña introducida coincide con la guardada en la BD
            if (password_verify($password, $claveBD)) {
                //Si el usuario no está bloqueado se inicia una sesión
                if ($usuario['bloqueado']==0){
                    session_start();
                    //Guardamos en variables de sesión el login del usuario y la hora de inicio de sesión
                    $_SESSION['usuario']=$login;
                    $_SESSION['hora'] = date('H:i:s');
                    //Redirigimos al usuario a la página de voluntarios
                    header("Location: voluntario.php"); 
                //Si el usuario está bloqueado, mostramos un mensaje avisando   
                }else {
                    echo "<p class='rojo centro'>*La cuenta está bloqueada. Contacte con el administrador para desbloquearla<p>";
                }
                //Si la contraseña es incorrecta
            } else {
                //Si existe el login del usuario en la BD
                if(existeLogin($conexion, $login)){
                    //Comprobamos de nuevo si el usuario estaba ya bloqueado, ya que se puede dar el caso
                    if ($usuario['bloqueado']==0){
                        //Utilizo una cookie para controlar el login del usuario y el número de intentos fallidos
                        //Si la cookie no existe significa que es el primer intento de un usuario
                        if(!isset($_COOKIE['login'])){            
                            $num_fallos = 1;
                            setcookie('login', $login, time() + 3600);
                            setcookie('num_fallos', $num_fallos, time() + 3600);
                            echo "<p class='rojo centro'>*La contraseña es incorrecta. Primer intento fallido, al tercer intento seguido fallido, su cuenta quedará bloqueada por seguridad<p>";
                        //Si la cookie existe, el número de fallos es uno y el usuario guardado en la cookie coincide con el introducido, incrementamos el contador de intentos en uno 
                        }else if($_COOKIE['num_fallos']==1 && $_COOKIE['login']==$login){
                            $num_fallos = 2;
                            setcookie('login', $login, time() + 3600);
                            setcookie('num_fallos', $num_fallos, time() + 3600);
                            echo "<p class='rojo centro'>*La contraseña es incorrecta. Segundo intento fallido, al tercer intento seguido fallido, su cuenta quedará bloqueada por seguridad<p>";
                        //Si la cookie existe, el número de fallos es uno y el usuario guardado en la cookie NO coincide con el introducido, ponemos el contador de intentos a 1   
                        }else if ($_COOKIE['num_fallos']==1 && $_COOKIE['login']!=$login){
                            $num_fallos = 1;
                            setcookie('login', $login, time() + 3600);
                            setcookie('num_fallos', $num_fallos, time() + 3600);
                            echo "<p class='rojo centro'>*La contraseña es incorrecta. Primer intento fallido, al tercer intento seguido fallido, su cuenta quedará bloqueada por seguridad<p>";
                        //Al tercer intento fallido seguido, eliminamos la cookie y bloqueamos la cuenta del usuario  
                        }else if($_COOKIE['num_fallos']==2 && $_COOKIE['login']==$login){  
                            setcookie('login', null, -1);
                            setcookie('num_fallos', null, -1);
                            if(bloqueaUsuario($conexion, $login)){
                                echo "<p class='rojo centro'>*Su cuenta ha sido bloqueada por seguridad al tercer intento fallido seguido. Contacte con un administrador para desbloquearla.<p>";
                            }else{
                                echo "<p class='rojo centro'>*Se ha producido un error al bloquear el usuario<p>";
                            }          
                        //Si la cockie existe, el número de fallos es dos y el usuario guardado en la cookie NO coincide con el introducido, tendremos que poner el contador a 1   
                        }else if($_COOKIE['num_fallos']==2 && $_COOKIE['login']!=$login){
                            $num_fallos = 1;
                            setcookie('login', $login, time() + 3600);
                            setcookie('num_fallos', $num_fallos, time() + 3600);
                            echo "<p class='rojo centro'>*La contraseña es incorrecta. Primer intento fallido,  al tercer intento seguido fallido, su cuenta quedará bloqueada por seguridad<p>";
                        }
                    } else {
                       echo "<p class='rojo centro'>*Su cuenta se encuentra bloqueada. Contacte con un administrador desbloquearlo.<p>";
                    }
                //Si el usuario no existe en la BD    
                } else {
                    echo "<p class='rojo centro'>*El usuario no existe<p>";
                }    
            }
            //Desconexión de la BD
            unset($conexion);           
        }
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tabl&oacute;n de anuncios</title>
    </head>
    <?php
    if (isset($_COOKIE['colorfondo'])) {
        //Ponemos el color de fondo en función del valor que contenga la cookie
        colorFondo($_COOKIE['colorfondo']);
    }
    
    ?>
    <p>Introduzca sus datos de acceso a continuaci&oacuten</p>
    <form action='login.php' method='post'>
        <?php
        formLoginUser();
        ?>
    </form>

    <p><a href="index.php">Volver</a><p>
    <?php
    //Si se pulsa la opción Crear anuncio del menú, redirigimos a la página anuncio.php
    if (isset($_POST['iniciarsesion'])) {
        header("location: login.php");
    }
    //Si se pulsa la opción Tablón del menú, redirigimos a la página tablon.php
    if (isset($_POST['invitado'])) {
        header("location: invitado.php");
    }
    //Si se pulsa la opción Preferencias del menú, redirigimos a la página preferencias.php
    if (isset($_POST['registrarse'])) {
        header("location: registro.php");
    } 
    
    ?>
    <footer>Mario David Ordóñez Tercero - Tarea 3 DWES - 2017/2018</footer>
    </body>
</html>