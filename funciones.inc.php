<!--Estilos-->
<style>
    p{
        text-align: center;
    }
    
    h1{
        font-size:50px;
        color:cadetblue;   
    }
    
    .menu{
        width:600px;
        
    }
   
    .itemPrincipal{
        background-color: #666666;
        border-radius: 5px;
        color:white;
        padding: 10px 10px;
        margin:8px;
        font-weight: bold; 

    }
    
    .item{
        border-radius: 5px;
        background-color: #CCCCCC;
        color:white;
        padding: 10px 10px;
        margin:8px;
        font-weight: bold;     
    }

    .centro{
        margin: 0 auto;
    }

    .menuPrincipal{
        text-align: center;
        margin: 20px;
    }

    .menuAdmin {
        text-align: center;
    }

    .fieldset{
        width:100px;
        height:150px;
        margin: 0 auto;
    }

    .fieldsetRegistro{
        height:200px;
        margin: 0 auto;
        width:310px;
    }

    .item2{
        border-radius: 5px;
        background-color: #CCCCCC;
        color:white;
        padding: 7px 7px;
        font-weight: bold; 
    }

    .menuUser {
        text-align: center;
    }

    .gris{
        background-color:#CCCCCC;
    }

    .rojo{
        color:red;
    }

    .verde{
        color:green;
    }

    .azul{
        color: #003366;
        font-weight: bold;
    }

    #contenedorAnuncios{
        height: auto;
        width:80%;
        margin: 0 auto;
    }

    .anunciosPublicos{
        height: auto;
        width: 70%;
        background-color: #E7D789;
        padding: 5px;
        margin: 0 auto;
        padding: 0.7em;
        border-radius:5px;
        word-wrap: break-word;
    }

    .anunciosPrivados{
        height: auto;
        width: 70%;
        background-color: #FFA062;
        padding: 5px;
        margin: 0 auto;
        padding: 0.7em;
        border-radius:5px;
        word-wrap: break-word;
    }

    .formanuncio{
        height: auto;
        width: 300px;
        margin: 0 auto;
    }

    .botonInsertar{       
        margin-left: 120px;
        margin-top: 7px;
    }

    .formPreferencias{
        height: auto;
        width: 400px;
        margin: 0 auto;

    }
    
    footer{
        text-align: center;
        margin-top:5px;
    }

</style>
<?php


/**
 * Función para abrir una conexión con la base de datos banca electrónica
 * @return Devuelve el objeto con la conexión a la base de datos
 */
function abrirConexion() {
    try {
        //Creamos la conexión para la base de datos banca electrónica, con usuario y contraseña dwes
        $conexion = new PDO('mysql:host=localhost;dbname=voluntarios3', 'dwes', 'dwes');
        //Definimos la fórmula a usar cuando haya errores
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Especificamos que vamos a trabajar con la codificación de caracteres utf8
        $conexion->exec("SET character SET utf8");
    } catch (Exception $ex) {
        print "<p class='rojo'>Error: " . $ex->getMessage() . "</p>";
        die();
    }

    return $conexion;
}

/**
 * Función para cerrar el cursor y la conexión con la base de datos
 */
function cerrarConexion($conexion, $sentencia) {

    try {
        $sentencia->closeCursor();
        $sentencia = null;
        $conexion = null;
    } catch (Exception $ex) {
        print "<p class='rojo'>Error: " . $ex->getMessage() . "</p>";
    }
}

/**
 * Función que crea el mensaje de bienvenida con su nombre y la hora de inicio de sesión de los usuarios logueados
 */

function bienvenida(){
    echo "<div id='bienvenida'>";
    echo "<p class='azul'>Bienvenid@ " . $_SESSION['usuario'] . "</p>";
    echo "<p class='azul'>Hora de acceso: " . $_SESSION['hora'] . "</p>";
    echo "</div>";
}


/*
 * Función que crea el menú principal de la aplicación
 */
function menu() {
      //Si se pulsa la opción Crear anuncio del menú, redirigimos a la página anuncio.php
    if (isset($_POST['iniciarsesion'])) {
        header("location: login.php");
    }
    //Si se pulsa la opción Tablón del menú, redirigimos a la página tablon.php
    if (isset($_POST['invitado'])) {
        session_start();
        $_SESSION['invitado'] = "INVITADO";
        $_SESSION['hora'] = date('H:i:m');
        header("location: invitado.php");
    }
    //Si se pulsa la opción Preferencias del menú, redirigimos a la página preferencias.php
    if (isset($_POST['registrarse'])) {
        header("location: registro.php");
    } 
    ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
    <?php
        echo "<div class='menuPrincipal'>";
        echo "<input type='submit' name='iniciarsesion' value='Iniciar sesión' class='itemPrincipal'/>";
        echo "<input type='submit' name='invitado' value='Acceder como invitado' class='itemPrincipal'/>";
        echo "<input type='submit' name='registrarse' value='Registrarse' class='itemPrincipal'/>";
        echo "</div>";
        echo "</form>";
    }

    /**
     * Función que crear el menú de Invitado
     */
    function menuInvitado() {
        ?>
    <form action="invitado.php" method="post">
        <?php
            echo "<div class='menuPrincipal'>";
            echo "<input type='submit' name='tablon' value='Tabl&oacute;n' class='itemPrincipal'/>";
            echo "<input type='submit' name='salir' value='Salir' class='itemPrincipal'/>";
            echo "</div>";
            ?>
    </form>
    <?php
    }

    /**
     * Función que crear el menú de Invitado
     */
    function menuVoluntario() {
        ?>
    <div class='menuPrincipal'>
        <form action="voluntario.php" method="post">
            <input type="submit" name="anuncio" value="Crear anuncio" class='itemPrincipal'>
            <input type="submit" name="tablon" value="Tabl&oacute;n" class='itemPrincipal'>
            <input type="submit" name="preferencias" value="Preferencias" class='itemPrincipal'>
            <input type="submit" name="cerrarsesion" value="Cerrar sesión" class='itemPrincipal'>
        </form>
    </div>
    <?php
    }

    /**
     * Función que crea el formulario de login de inicio de sesión de los usuarios
     */
    function formLoginUser() {
        ?>
    <fieldset class='fieldset'>
        <legend>Login usuario</legend>
        <table class='centro'>
            <tr>
                <td>Usuario:</td>
                <td><input type='text' name='login' value='<?php if (isset($_POST['login'])) echo $_POST['login']; ?>'/></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type='password' name='password' value='<?php if (isset($_POST['password'])) echo $_POST['password']; ?>' />
            </tr>
            <br>
            <tr>
                <td></td>
                <td><br><input type='submit' name='iniciar' value='Iniciar' style='margin-left:18px;' /></td>
            </tr>
        </table>
    </fieldset>
    <?php
    }

    /**
     * Función que crea el formulario de registro de usuario
     */
    function formRegistro() {
        ?>
    <br>
    <fieldset class='fieldsetRegistro'>
        <legend>Formulario de registro</legend>
        <table class='centro'>
            <tr>
                <td>Login:</td>
                <td><input type="text" name="login" value='<?php if (isset($_POST['login'])) echo $_POST['login']; ?>' size="18" autofocus maxlength="20"/></td>
            </tr><br>
            <tr>
                <td>Contraseña:</td>
                <td><input type="password" name="password" value='<?php if (isset($_POST['password'])) echo $_POST['password']; ?>' size="18" maxlength="128"/></td>
            </tr>
            <tr>
                <td>Repite contraseña:</td>
                <td><input type="password" name="password2" value='<?php if (isset($_POST['password2'])) echo $_POST['password2']; ?>' size="18" maxlength="128"/></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" value='<?php if (isset($_POST['email'])) echo $_POST['email']; ?>' size="18" maxlength="50"/></td>
            </tr>
            <tr>
                <td style="text-align:center;"><br><input type="submit" name="guardar" value="Guardar" /></td>
                <td style='text-align:center;'><br><input type="submit" name="volver" value="Volver" /></td>
            </tr>
            <input type="hidden" name="bloqueado" value="1" />
        </table>
    </fieldset>
</form>
<?php
}

/**
 * Función que crea el formulario para insertar un anuncio
 */
function formAnuncio() {
    ?>
<div class='formanuncio'>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class='formAnuncio'>
        Inserte su anuncio a continuación:<br>
        <textarea cols="40" rows="10" maxlength="500" name="contenido"><?php if (isset($_POST['contenido'])) echo $_POST['contenido'] ?></textarea>
        <br>
        ¿Desea que sea privado?:
        S&iacute;<input type="radio" name="opcion" value="1" <?php if (isset($_POST['opcion'])) { if ($_POST['opcion']==1) { echo "checked" ; } } else $_POST['opcion']=null; ?>/>
        No<input type="radio" name="opcion" value="0" <?php if (isset($_POST['opcion'])) { if ($_POST['opcion']==0) { echo "checked" ; } } else $_POST['opcion']=null; ?>/>
        <br>
        <input type="submit" name="insertar" value="Insertar" align='center' class='botonInsertar'>
    </form>
</div>
<?php
}

/**
 * Función que crea el formulario para establecer las preferencias
 */
function formPreferencias() {
    ?>
<div class='formPreferencias'>
    <form action="preferencias.php" method="post">
        <table>
            <tr>
                <!--Desplegable para seleccionar el color de fondo-->
                <td align='center'>
                    Selecciona el color de fondo:</td>
                <td align='center'><select name="color">
                        <option>Blanco</option>
                        <option>Azul</option>
                        <option>Verde</option>
                        <option>Rojo</option>
                    </select></td>
            </tr>
            <tr>
                <td align='center'>
                    <input type="submit" name="establecer" id="establecer" value="Establecer color de fondo"></td>
                <td align='center'><input type="submit" name="eliminacookie" id="eliminacookie" value="Restablecer preferencias"></td>
            </tr>
        </table>
    </form>
</div>

<?php
}

/**
 * Función para insertar un usuario en la base de datos
 * @param type $conexion Conexión con la base de datos banca electrónica
 * @return type Devuelve true si se ha insertado el usuario correctamente y false en caso contrario
 */
function insertarUsuario($conexion, $login, $passwordCrypt, $email, $bloqueado) {
    //Variable para comprobar si se ha insertado correctamente el usuario o no
    $usuarioInsertado = false;
    if (isset($conexion)) {
        try {
            //Consulta
            $sql = "INSERT INTO anunciantes (login, password, email, bloqueado) VALUES (:login, :password, :email, :bloqueado)";
            //Preparamos la consulta
            $sentencia = $conexion->prepare($sql);
            //Ejecutamos la consulta y guardamos en la variable usuarioInsertado el valor devuelto, true si se ha insertado y false si no
            $usuarioInsertado = $sentencia->execute(array(":login" => $login, ":password" => $passwordCrypt, ":email" => $email, ":bloqueado" => $bloqueado));
        } catch (PDOException $ex) {
            print "<p class='rojo'>Error: " . $ex->getMessage() . "</p>";
        }
        //Cerramos el cursor y la conexión con la base datos
        cerrarConexion($conexion, $sentencia);
    }

    return $usuarioInsertado;
}

/**
 * Función que comprueba si el login introducido en un formulario existe en la
 * base de datos
 * @param type $conexion
 * @param type $login
 * @return boolean Devuelve true si el login existe en la base de datos y false
 * en caso contrario
 */
function existeLogin($conexion, $login) {

    if (isset($conexion)) {
        try {
            $sql = "SELECT * FROM anunciantes WHERE login=:login";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute(array(':login' => $login));
            $resultado = $sentencia->fetchAll();
            //Si existe ese login devuelve true
            if (count($resultado) > 0) {
                return true;
                //Si no existe, devuelve false
            } else {
                return false;
            }
            //Cerramos conexión con la base de datos
            cerrarConexion($conexion, $sentencia);
        } catch (PDOException $ex) {
            echo "<p class='rojo'>Error: " . $ex->getMessage() . "</p>";
        }       
    }
}

/**
 * Función que comprueba si el email introducido en un formulario existe en la
 * base de datos
 * @param type $conexion
 * @param type $email
 * @return boolean Devuelve true si el email ya está en uso y false en caso
 * contrario
 */
function existeEmail($conexion, $email) {

    if (isset($conexion)) {
        try {
            $sql = "SELECT * FROM anunciantes WHERE email=:email";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute(array(':email' => $email));
            $resultado = $sentencia->fetchAll();
            //Si existe el email devuelve true
            if (count($resultado) > 0) {
                return true;
                //Si no existe, devuelve false
            } else {
                return false;
            }
            //Cerramos conexión con la base de datos
            cerrarConexion($conexion, $sentencia);
        } catch (PDOException $ex) {
            echo "<p class='rojo'>Error: " . $ex->getMessage() . "</p>";
        }
    }
}

/**
 * Metodo que devuelve un array con el usuario o falso si no existe
 * 
 * @param  string $user
 * @return array
 */
 function getUser($login, $conexion) {
       
        try{
        $sql = 'SELECT * FROM anunciantes WHERE login=:login';
        $resultado = $conexion->prepare($sql);
        $resultado->execute(array(':login'=>$login));
        $usuario = false;

        //Si existe algún resultado
        if ($resultado->rowCount() > 0) {
            //Guardamos los datos de la consulta
            $usuario = $resultado->fetch();
        } 
        }catch(PDOException $ex){
            echo "Error:" . $ex->getMessage();
        }
        
        cerrarConexion($conexion, $resultado);
        return $usuario;
    }

/**
 * Función que actualiza el campo bloqueado de un usuario a 1, quedando su cuenta bloqueada
 * @param  PDO $conexion Objeto conexión con la BD
 * @param  string $login Login de usuario
 * @return $bloqueado Devuelve true si se actualizó correctamente y false en caso contrario
 */
function bloqueaUsuario($conexion, $login){
    try{
        $sql = 'UPDATE anunciantes SET bloqueado=1 WHERE login=:login';
        $resultado = $conexion->prepare($sql);
        $bloqueado=$resultado->execute(array(':login'=>$login));
        cerrarConexion($conexion, $resultado);
    }catch(PDOException $ex){
        echo "Error:" . $ex->getMessage();
    }
    
    return $bloqueado;
}

/**
 * Función que inserta un anuncio en la base de datos
 * @param type $conexion
 * @param type $id
 * @param type $autor
 * @param type $contenido
 * @param type $fecha
 * @param type $privado
 * @return booleano Devuelve true si se inserta el anuncio correctamente y
 * false en caso contrario
 */
function insertarAnuncio($conexion, $id, $autor, $contenido, $fecha, $privado) {
    $anuncioInsertado = false;
    if (isset($conexion)) {
        try {
            $sql = "INSERT INTO anuncios (id_anuncio, autor, contenido, fecha, privado) VALUES (:id_anuncio, :autor, :contenido, :fecha, :privado)";
            $sentencia = $conexion->prepare($sql);
            $anuncioInsertado = $sentencia->execute(array(":id_anuncio" => $id, ":autor" => $autor, ":contenido" => $contenido, ":fecha" => $fecha, ":privado" => $privado));
            //Cerramos el cursor y la conexión con la base de datos
            cerrarConexion($conexion, $sentencia);
        } catch (Exception $ex) {
            print "<p class='rojo'>Error: " . $ex->getMessage() . "</p>";
        }
    }

    return $anuncioInsertado;
}

/**
 * Función que comprueba si el login y la contraseña introducidos en el 
 * formulario existe en la base de datos
 * @param type $conexion
 * @param type $login
 * @return boolean Devuelve true si el login existe en la base de datos y false
 * en caso contrario
 */
function existeLoginyClave($conexion, $login, $password) {

    if (isset($conexion)) {
        try {
            $contador = 0;
            $sql = "SELECT * FROM anunciantes WHERE login=:login";
            $resultado = $conexion->prepare($sql);
            $resultado->execute(array(':login' => $login));
            //Mientras encuentre registros (si encuentra, encontrará uno solo, ya que no puede haber dos logins idénticos
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                //Comparamos la contraseña introducida con la de la base de datos
                if (password_verify($password, $registro['password'])) {
                    $contador++;
                }
            }
            //Si encuentra coincidencias devuelve true
            if ($contador > 0) {
                return true;
                //si no, devuelve false
            } else {
                return false;
            }
            //Cerramos el cursor y la conexión con la base de datos
            cerrarConexion($conexion, $resultado);
        } catch (PDOException $ex) {
            echo "<p class='rojo'>Error: " . $ex->getMessage() . "</p>";
        }
        //Cerramos el cursor y la conexión con la base datos
        cerrarConexion($conexion, $resultado);
    }
}

/**
 * Función para mostrar todos los anuncios, tanto los públicos como los privados
 * @param type $conexion
 */
function mostrarAnuncios($conexion) {
    if (isset($conexion)) {
        try {
            $sql = "SELECT * FROM anuncios";
            $resultado = $conexion->prepare($sql);
            $resultado->execute();

            echo "<div id='contenedorAnuncios'>";
            //Mientras encuentre anuncios
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                //Si el anuncio es privado le ponemos un color de fondo verde
                if ($registro['privado'] == '1') {
                    echo "<div class='anunciosPrivados'>" . "<div style=float:left;font-size:0.8em;color:blue;>Escrito por: " . $registro['autor'] . "</div>" . "<div style=float:right;font-size:0.8em;color:blue;>Fecha: " . $registro['fecha'] . "</div>" . "<div style=clear:both;>" . $registro['contenido'] . "</div>" . "</div>";
                    echo "<br>";
                    //Si el anuncio es público le ponemos un color de fondo blanco
                } else {
                    echo "<div class='anunciosPublicos'>" . "<div style=float:left;font-size:0.8em;color:blue;>Escrito por: " . $registro['autor'] . "</div>" . "<div style=float:right;font-size:0.8em;color:blue;>Fecha: " . $registro['fecha'] . "</div>" . "<div style=clear:both;>" . $registro['contenido'] . "</div>" . "</div>";
                    echo "<br>";
                }
            }
            echo "</div>";
            //Cerramos el cursor y la conexión con la base de datos
            cerrarConexion($conexion, $resultado);
        } catch (PDOException $ex) {
            echo "<p class='rojo'>Error: " . $ex->getMessage() . "</p>";
        }
    }
}

/**
 * Función para mostrar sólo los anuncios públicos
 * @param type $conexion
 */
function mostrarAnunciosPublicos($conexion) {
    if (isset($conexion)) {
        try {
            $sql = "SELECT * FROM anuncios WHERE privado=0";
            $resultado = $conexion->prepare($sql);
            $resultado->execute();
            echo "<div id='contenedorAnuncios'>";
            //Mientras encuentre anuncios públicos los imprime por pantalla
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='anunciosPublicos'>" . "<div style=float:left;font-size:0.8em;color:blue;>Escrito por: " . $registro['autor'] . "</div>" . "<div style=float:right;font-size:0.8em;color:blue;>Fecha: " . $registro['fecha'] . "</div>" . "<div style=clear:both;>" . $registro['contenido'] . "</div>" . "</div>";
                echo "<br>";
            }
            echo "</div>";
            //Cerramos el cursor y la conexión con la base datos
            cerrarConexion($conexion, $resultado);
        } catch (PDOException $ex) {
            echo "<p class='rojo'>Error: " . $ex->getMessage() . "</p>";
        }
    }
}

/**
 * Función que valida los campos de crear anuncio
 * @param type $anuncio
 * @param type $privado
 * @return array Devuelve un array con los errores encontrados
 */
function validarCamposAnuncio($conexion, $id, $usuario, $contenido, $fecha, $privado) {

    //Array donde se almacenarán todos los errores al validar
    $errores = array();
    //Si el campo anuncio está vacío
    if ($contenido == "") {
        array_push($errores, "<p class='rojo'>*El campo anuncio no puede estar vacío</p>");
    }
    //Si no está seleccionada ninguna opción del radio button privado
    if ($privado == null) {
        array_push($errores, "<p class='rojo'>*Debe seleccionar si es privado o no</p>");
    }
    //Si existe algún error
    if (count($errores) > 0) {
        //Se recorre el array de errores y se muestran todos los que haya
        for ($i = 0; $i < count($errores); $i++) {
            echo $errores[$i];
        }
        //Si no existe ningún error
    } else
    if (count($errores) == 0) {
        //Intentamos insertar el anuncio
        $anuncioInsertado = insertarAnuncio($conexion, $id, $usuario, $contenido, $fecha, $privado);
        //Si todo ha ido bien
        if ($anuncioInsertado) {
            echo "<p class='verde'>Anuncio insertado correctamente</p>";
            //Ocultamos el formulario
            ?>
<style>
    .formAnuncio {
        display: none
    }

</style>
<!--Mostramos un enlace por si el usuario quiere insertar otro anuncio-->
<p class='centro'><a href="anuncio.php">Insertar otro anuncio</a></p>
<?php
            //Si ha habido algún problema al insertar el anuncio
        } else {
            echo "<p class='rojo'>*Error al insertar el anuncio</p>";
        }
    }
    return $errores;
}

/**
 * Función que valida los campos del formulario de registro
 * @param type $conexion
 * @param type $login
 * @param type $password1
 * @param type $password2
 * @param type $email
 */
function validarCamposRegistro($conexion, $login, $password1, $password2, $email) {
    //Array donde se almacenarán todos los errores al validar
    $errores = array();
    //Si el campo login está vacío
    if ($login == "") {
        array_push($errores, "<p class='rojo'>*El campo login no puede estar vacío</p>");
    } else
    //Si el login tiene más de 20 caracteres
    if (strlen($login) > 20) {
        array_push($errores, "<p class='rojo'>*El  login no puede tener más de 20 caracteres</p>");
    }
    //Si alguno de los campos de contraseña están vacíos
    if ($password1 == "" || $password2 == "") {
        array_push($errores, "<p class='rojo'>*El campo password no puede estar vacío</p>");
    } else
    //Si las contraseñas no coinciden
    if ($password1 != $password2) {
        array_push($errores, "<p class='rojo'>*Las contraseñas no coinciden</p>");
    }
    //Si el campo email está vacío
    if ($email == "") {
        array_push($errores, "<p class='rojo'>*El campo email no puede estar vacío</p>");
    } else
    //Si el campo email tiene más de 50 caracteres
    if (strlen($email) > 50) {
        array_push($errores, "<p class='rojo'>*El email no puede tener más de 50 caracteres</p>");
    } else
    //Si el formato del email no es válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errores, "<p class='rojo'>*El formato del email no es válido</p>");
    } else
    //Si el email ya está en uso
    if (existeEmail($conexion, $email)) {
        array_push($errores, "<p class='rojo'>*El email ya está en uso</p>");
    }
    //Si existen errores
    if (count($errores) > 0) {
        //Recorremos el array de errores y mostramos todos los que haya
        for ($i = 0; $i < count($errores); $i++) {
            echo $errores[$i];
        }
        //Si no hay errores
    } else
    //Comprobamos que no exista el login en la base de datos
    if (!existeLogin($conexion, $login)) {
        //Intentamos realizar el registro del usuario en la base de datos
        $usuarioInsertado = insertarUsuario($conexion, $_POST['login'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['email'], true);
        //Si todo ha ido bien
        if ($usuarioInsertado) {
            echo "<p class='verde'>Usuario registrado correctamente";
            unset($_POST['login']);
            unset($_POST['password']);
            unset($_POST['password2']);
            unset($_POST['email']);
            //Si no se ha podido registrar al usuario
        } else {
            echo "<p class='rojo'>*Error al registrarse</p>";
        }
        //Si el login ya está en uso
    } else {
        echo "<p class='rojo'>*Ya existe un usuario con ese login</p>";
    }
}

/**
 * Función que establece el color de fondo de todas las páginas en función
 * del valor de la cookie que guarda el color establecido que se le pasa por
 * parámetro
 * @param type $colorfondo
 */
function colorFondo($colorfondo) {
    switch ($colorfondo) {
        case "Blanco":
            echo "<body bgcolor=\"#FFFFFF\">";
            break;
        case "Azul":
            echo "<body bgcolor=\"#0099FF\">";
            break;
        case "Verde":
            echo "<body bgcolor=\"#008000\">";
            break;
        case "Rojo":
            echo "<body bgcolor=\"#FF6666\">";
            break;
        default:
            echo "<body bgcolor=\"#FFFFFF\">";
    }
}
