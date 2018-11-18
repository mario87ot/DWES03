<?php
//Reanudamos la sesión
session_start();
//Destruimos la sesión
session_destroy();
//Redigirimos a la página de inicio
header("location: index.php");
