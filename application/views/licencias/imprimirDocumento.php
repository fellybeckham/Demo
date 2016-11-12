<?php
//$Referencia = $_GET["Referencia"];
//$file = 'http://127.0.0.1/GuadalajaraServicios/Guadalajara/index.php/siapa/ticket?comando=cobrar&total=0&cuenta=----------&importetotal=0&TipoPago=E';
$url = base_url();
$file = $url.'archivo.pdf';
$filename = 'archivo.pdf'; /* Note: Always use .pdf at the end. */

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');
@readfile($file);
?>