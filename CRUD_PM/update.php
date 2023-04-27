<?php
	session_start();
	//Si existe la sesión "cliente"..., la guardamos en una variable.
	if (isset($_SESSION['usuarios'])){
		$cliente = $_SESSION['usuarios'];
	}else{
   header('Location: ../index.php');//Aqui lo redireccionas al lugar que quieras.
	 die() ;
   
	}

	require '../Config/conexion.php';

	//modifica la imagen en catalogo de productos

	$id = $_POST['id'];	
	$Partnumber = $_POST['part_number'];	
	$url_ficha = $_POST['url_ficha'];
	
	$Partnumber = str_replace(" ", "_", $Partnumber);
	$Partnumber = str_replace("-", "_", $Partnumber);
	
	$directorio='../imagenescargadas/';
	$directorioabd="";
	$img=$_FILES['imagen'];
	$type=$_FILES['imagen']["type"];
	$subir_archivo="";
	$imagensubida="";

	$separada = explode("/", $type);
	$type= end($separada);
	if ($img["name"]!="" || $img["name"]!=null){

		if($type=="png" || $type=="jpg" || $type=="jpeg"){

			$directorioabd="/"."imagenescargadas/";
		$archivoimgmove=$_FILES['imagen']['tmp_name'];		
        $PaQueOrionNoEsteChingando=utf8_decode($_FILES['imagen']['name']);
		$separadaimg = explode(".", $PaQueOrionNoEsteChingando);
		$couninmg=count($separadaimg);
		

		if($couninmg==2){
			
			$extencion=$separadaimg[1];
			$hoy = date("Y_m_d_i");
			$PaQueOrionNoEsteChingando="";
			$PaQueOrionNoEsteChingando=$Partnumber."_".$hoy.".".$extencion;
			$imagensubida=$PaQueOrionNoEsteChingando;
			
		}
		elseif($couninmg==3){
			$extencion=$separadaimg[2];
			$hoy = date("Y_m_d_i");
			$PaQueOrionNoEsteChingando="";
			$PaQueOrionNoEsteChingando=$Partnumber."_".$hoy.".".$extencion;
			$imagensubida=$PaQueOrionNoEsteChingando;

			
		}
		
		
		//var_dump($separadaimg);
		
		$subir_archivo = $directorio.basename($PaQueOrionNoEsteChingando);		
        move_uploaded_file($archivoimgmove, $subir_archivo);

			
		}
		
		
	}
	
	
	$directoriopdf='../pdfcarga/';
	$directorioabdpdf="";
	$pdf=$_FILES['pdf'];
	$typepdf=$_FILES['pdf']['type'];
	$separadas = explode("/", $typepdf);
	$typepdf= end($separadas);
	

	if ($pdf["name"]!="" || $pdf["name"]!=null){

		if($typepdf=="pdf"){
			$directorioabdpdf="/"."pdfcarga/";
		$archivopdfmove=$_FILES['pdf']['tmp_name'];		
		$PaQueOrionNoEsteChingandoPDF=str_replace(' ', "_",$directorioabdpdf.basename($_FILES['pdf']['name']));
		$directorioabdpdf="https://apir.yespointos.net/SalavRefaccion".$PaQueOrionNoEsteChingandoPDF;
		//echo $directorioabdpdf;
		$subir_archivopdf = $directoriopdf.basename($PaQueOrionNoEsteChingandoPDF);		
        move_uploaded_file($archivopdfmove, $subir_archivopdf);

		}

		

		
	}


	$url_ficha= $mysqli->real_escape_string($url_ficha);
	$imagensubida=$mysqli->real_escape_string($imagensubida);

	$directorioabdpdf=$mysqli->real_escape_string($directorioabdpdf);
	$subir_archivo=$mysqli->real_escape_string($subir_archivo);
	$id=$mysqli->real_escape_string($id);
	
	$sql = "UPDATE catalogo_producto SET url_ficha='$url_ficha', imagen='$imagensubida', pdf='$directorioabdpdf', imglo='$subir_archivo' WHERE id = '$id'";
	$resultado = $mysqli->query($sql);
	
?>

<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
				<?php if($resultado) { ?>
				<h3>REGISTRO MODIFICADO</h3>
				<?php } else { ?>
				<h3>ERROR AL MODIFICAR</h3>
				<?php } ?>
				
				<a href="buscador.php" class="btn btn-primary">Regresar</a>
				
				</div>
			</div>
		</div>
	</body>
</html>
