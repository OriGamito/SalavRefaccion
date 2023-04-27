<?php
use LDAP\Result;
$conf = include 'Config/config.php';
$hostname = $conf['hostname'];
$username = $conf['username'];
$password = $conf['password'];
$db = $conf['bd'];
$con = mysqli_connect($hostname, $username, $password, $db);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!$con) {
    die("Failed to establish connection");
}

session_start();

if(isset($_POST['usuario'])&& !empty($_POST['password']) && !empty($_POST['password'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    
    $nombreUsuario = $con->real_escape_string($usuario);
    $contraseñaUsuario = $con->real_escape_string($password);

    $query = "SELECT * FROM `Login` WHERE Usuario='$nombreUsuario' and Contrasena='$contraseñaUsuario'";
    $result = mysqli_query($con, $query); 
        
    if(mysqli_num_rows($result)>0){        
        $_SESSION["usuarios"]="adminsalav";
        echo json_encode(array('success'=>1));
       }else{
        echo json_encode(array('success'=>0));
       }

    }else{
        echo json_encode(array('success'=>0));

    }


?>