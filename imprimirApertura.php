<?php
// Get cURL resource
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/practicas/CapturaApertura.php',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        "paterno" => "JIMENEZ",
        "materno" => "ALVAREZ",
        "nombre" => "JOSE ALFREDOX",
        "numtelefono" => "3124567836",
        "email" => "alfredo.kiotech@gmail.com",
        "giro" => "1",
        "establecimiento" => "ELMASBARATO",
        "calle" => "moreno",
        "numext" => "232",
        "colonia" => "VALLE",
        "codpostal" => "28000",
        "calle1" => "GARZAS",
        "calle2" => "PELICANOS",
        "numempleos" => "8",
        "investimada" => "100000",
        "sesion" => "7gjricmccg6ckie8b5g05f5j46"
    )
));
$resp = curl_exec($curl);
header('Content-type: application/pdf');
echo $resp;
//var_dump($resp);
curl_close($curl);


?>