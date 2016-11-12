<?php 
header("Content-type:text/xml");
ob_clean();
flush();

//$data = json_decode( $_GET["DATOS_ACTA"].'&#38;='.$rue);
//var_dump($data);

$comando ="imprimir";// El comando se asigna fijo segun lo que se requiera realizar (imprimir o cobrar)
 
 //Aqui se reciben las variables del formulario por el método GET

$REFERENCIAS = "refer";    

$url =  base_url();
$urlnegado = base_url().'frmErrorServicio.php';
//$document = $url.'licencias/imprimirDocumentoApertura?paterno='.$paterno.'&#38;materno='.$materno.'&#38;nombre='.$nombre.'&#38;numtelefono='.$numtelefono.'&#38;email='.$email.
//'&#38;giro='.$giro.'&#38;girocomple='.$girocomple.'&#38;establecimiento='.$establecimiento.'&#38;calle='.$calle.'&#38;numext='.$numext.'&#38;colonia='.$colonia.
//'&#38;codpostal='.$codpostal.'&#38;calle1='.$calle1.'&#38;calle2='.$calle2.'&#38;numempleos='.$numempleos.'&#38;Investimada='.$Investimada.'&#38;sesion='.$sesion;
 //$document = $url.'licencias/imprimir';   
$document = $url.'archivo.pdf';      
    echo '<?xml version="1.0" encoding="utf-8"?>
        <mensaje>
            <comando>imprimir</comando>
            <cantidad>1</cantidad>
            <idservicio>30</idservicio>
            <referencia>'.$paterno.'</referencia>
            <documento>'.$document.'</documento>
        </mensaje>';
?>

<?php 
/*$Referencia = $_GET["Referencia"];
$file = './pdf/'.$Referencia.'.pdf';
$filename = $Referencia.'.pdf'; /* Note: Always use .pdf at the end. */

/*header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');

@readfile($file);*/
?>