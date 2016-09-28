<?php 
header("Content-type:text/xml");
ob_clean();
flush();
//$data = json_decode( $_GET["DATOS_ACTA"], true);
//var_dump($data);
$TipoPago = $_GET["tipo"];


$comando ="cobrar";
 

$url =  base_url()."agua";
// $urlnegado = $url.'/cancelar?comando=comando'
// .'&#38;NOMBRE_FALLECIDO='.$_GET["NOMBRE_FALLECIDO"].'&#38;PRIMER_APELLIDO_FALLECIDO='.$_GET["PRIMER_APELLIDO_FALLECIDO"].'&#38;FECHA_DEFUNCION='.$_GET["FECHA_DEFUNCION"]
// .'&#38;SEGUNDO_APELLIDO_FALLECIDO='.$_GET["SEGUNDO_APELLIDO_FALLECIDO"].'&#38;TipoPago='.$TipoPago
// .'&amp;importe='.$importe.'&#38;CANT_ACTAS='.$cantidaActas.'&#38;total='.$importetotal;
$document = $url.'/RegistraPago?comando='.$comando.'&amp;importetotal='.$_GET['importetotal'].'&#38;tipo='.$_GET['tipo'].'&#38;numerocontrato='.$_GET['numerocontrato'].'&#38;session='.$_GET['sesion'];
    $xmlRet = '<?xml version="1.0" encoding="utf-8"?>
    <mensaje>
    <comando>cobrar</comando>
    <cantidad>1</cantidad>
    <idservicio>6</idservicio>
    <referencia>'.$_GET['numerocontrato'].'</referencia>
    <importe>'.$_GET['importetotal'].'</importe>
    <total>'.$_GET['importetotal'].'</total>
    <tipopago>'.$TipoPago.'</tipopago>      
    <urlaprobado></urlaprobado>
    <ticket>'.$document.'</ticket>                 
    <urldenegado>'.$url.'/ErrorServer</urldenegado>           
    </mensaje>';
    settype ($xmlRet,"string"); 
    echo $xmlRet;

?>