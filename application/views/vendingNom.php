<?php
	header("Content-type:text/xml");
	ob_clean();
 	flush();
//Crear XML
	//$curp= $_GET['curp'];
	$nombre= $_GET['nombre'];
	$primer_apellido= $_GET['primer_apellido'];
	$segundo_apellido= $_GET['segundo_apellido'];
	$cantidad = 1;
	$urlaprobado= utf8_encode($_GET['urlaprobado']) ;
	
	$urlaprobado = str_replace("&","&amp;",$urlaprobado);
	$urlaprobado = str_replace("%3B","",$urlaprobado);
	$urlaprobado = str_replace("%26%2339","%27",$urlaprobado);
	
	$nombre= str_replace("'","", $nombre);
	$primer_apellido= str_replace("'","", $primer_apellido);
	$segundo_apellido= str_replace("'","", $segundo_apellido);
	
		echo '<?xml version="1.0" encoding="utf-8"?>
			<mensaje>
				<comando>imprimir</comando>
				<cantidad>1</cantidad>
				<idservicio>3</idservicio>
				<referencia>'.$nombre.' '.$primer_apellido.' '.$segundo_apellido .'</referencia>
				<documento>'.$urlaprobado.'</documento>
			</mensaje>';
		 
	/*$nombre="ActasNac.xml";
		$archivo= fopen($nombre,"w+");
		fwrite($archivo,$xml);
		fclose($archivo);
		

		echo "<script languaje='javascript'>location.href='ActasNac.xml';</script>";	
		*/
//		date_default_timezone_set("America/Mexico_City");
//require 'logs.php';
//	logSW('genera xml curp'.' curp='.$curp.' urlaprobado='.$urlaprobado);
//		exit;
//		
		
		
		

//echo($datos);	
//echo $hola;
?>