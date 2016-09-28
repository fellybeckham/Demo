<?php 
header("Content-type:text/xml");
ob_clean();
flush();
//$data = json_decode( $_GET["DATOS_ACTA"], true);
//var_dump($data);
$TipoPago = "E";
// if ($_GET["tipo_pago"] == "T") {
//     $TipoPago="T";
// }     

$comando ="cobrar";
 

$url =  base_url()."predial";
// $urlnegado = $url.'/cancelar?comando=comando'
// .'&#38;NOMBRE_FALLECIDO='.$_GET["NOMBRE_FALLECIDO"].'&#38;PRIMER_APELLIDO_FALLECIDO='.$_GET["PRIMER_APELLIDO_FALLECIDO"].'&#38;FECHA_DEFUNCION='.$_GET["FECHA_DEFUNCION"]
// .'&#38;SEGUNDO_APELLIDO_FALLECIDO='.$_GET["SEGUNDO_APELLIDO_FALLECIDO"].'&#38;TipoPago='.$TipoPago
// .'&amp;importe='.$importe.'&#38;CANT_ACTAS='.$cantidaActas.'&#38;total='.$importetotal;

$document = $url.'/RegistraPago?comando='.$comando.'&amp;importe='.$_GET['montoadeudo'].'&#38;OFICINA='
.$_GET['oficina'].'&#38;TIPO='.$_GET['tipo'].'&#38;NUMPREDIAL='.$_GET['numpredio']
.'&#38;SESION='.$_GET['sesion'].'&#38;MONTOADEUDO='.$_GET['montoadeudo'];
      
//FINAL DE ACTA
$urlTicket= '';

if($comando=='imprimirTicket'){
    $xmlRet = '<?xml version="1.0" encoding="utf-8"?>
        <mensaje>
            <comando>imprimirTicket</comando>
            <cantidad></cantidad>
            <idservicio>6</idservicio>
            <referencia>'.$REFERENCIAS.'</referencia>
            <documento>'.$urlTicket.'</documento>
        </mensaje>';
    settype ($xmlRet,"string");
    echo $xmlRet;
}elseif($comando=='cobrar'){
    $xmlRet = '<?xml version="1.0" encoding="utf-8"?>
    <mensaje>
    <comando>cobrar</comando>
    <cantidad>1</cantidad>
    <idservicio>5</idservicio>
    <referencia>'.$_GET['oficina'].'-'.$_GET['tipo'].'-'.$_GET['numpredio'].'-'.strtoupper($_GET['Apellido']).'</referencia>
    <importe>'.$_GET['montoadeudo'].'</importe>
    <total>'.$_GET['montoadeudo'].'</total>
    <tipopago>'.$TipoPago.'</tipopago>      
    <urlaprobado></urlaprobado>
    <ticket>'.$document.'</ticket>                 
    <urldenegado>'.$url.'/ErrorServer</urldenegado>           
    </mensaje>';
    settype ($xmlRet,"string"); 
    echo $xmlRet;
}   

?>