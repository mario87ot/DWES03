<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Tablón de anuncios</title>
</head>
<?php
    include 'funciones.inc.php';
    
    if (isset($_COOKIE['colorfondo'])) {
        //Ponemos el color de fondo en función del valor que contenga la cookie
        colorFondo($_COOKIE['colorfondo']);
    }
    
    ?>

<div class="contenedor">
    <?php 
        menu();
    ?>

    <footer>Mario David Ordóñez Tercero - Tarea 3 DWES - 2017/2018</footer>
</div>
</body>

</html>
