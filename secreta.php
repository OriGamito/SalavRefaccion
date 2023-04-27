<?php
# Si no entiendes el código, primero mira a login.php

# Iniciar sesión para usar $_SESSION
session_start();

$_SESSION["usuarios"] = $_POST['username'];
echo $_POST['username'];

# Y ahora leer si NO hay algo llamado usuario en la sesión,
# usando empty (vacío, ¿está vacío?)
# Recomiendo: https://parzibyte.me/blog/2018/08/09/isset-vs-empty-en-php/
/*
if (empty($_SESSION["usuarios"])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: index.html");
    # Y salimos del script
    exit();
}else{
    header("Location: Menu.php");
}*/


?>
