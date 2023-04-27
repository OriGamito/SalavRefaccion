<?php


//Conexion a la db
require_once "todoslosarchivos.php";
$conf = include 'Config/config.php';
set_time_limit(3600);
ini_set('memory_limit', '9999999999999G');
ini_set('max_execution_time', 3600);
ini_set('max_input_time', 3600);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hostname = $conf['hostname'];
$username = $conf['username'];
$password = $conf['password'];
$db = $conf['bd'];



$arrayConnConfig['host'] = $conf['hostname'];
$arrayConnConfig['user'] = $conf['username'];
$arrayConnConfig['pass'] = $conf['password'];
$arrayConnConfig['name'] =  $conf['bd'];
$arrayConnConfig['table'] = 'inventarioo';

$con = mysqli_connect($hostname, $username, $password, $db);
if (!$con) {
    die("Failed to establish connection");
}


$id = 0;


//Recorre la tabla usuario para obtener la sucursales

$consultasiexiste = "SELECT DISTINCT sucursal_id FROM `usuario`";

$row = null;
       

$consultasiexiste = mysqli_query($con, $consultasiexiste);
while ($row = mysqli_fetch_assoc($consultasiexiste)) {
    $user = "";
    $sucid = $row["sucursal_id"];
    //$idu = $row["id"];


    //se direje a la funcion para crear y consultar tablas de los zips
    
    $obj = new MySqlBackupLite($arrayConnConfig);
    $obj->zipcreation($user, $sucid,$arrayConnConfig);
}

