<?php
	
	$mysqli = new mysqli('localhost', 'yespoint_Ef', 'salav1234@', 'yespoint_salavrefac');
	$mysqli -> set_charset("utf8");
	if($mysqli->connect_error){
		
		die('Error en la conexion' . $mysqli->connect_error);
		
	}
?>