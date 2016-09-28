<?php

class Predial_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
        $this->load->database();
    }

    public function inicioSession(){
    	//Leer archivo de oficina
		$file = fopen("Oficina.txt", "r");
		while(!feof($file)) {
		 $algo[] = fgets($file);
		}
		fclose($file);
    	// Get cURL resource
		$curl = curl_init();
		//URL PRODUCCION http://morelos.morelia.gob.mx:85/kiosco/inicio.php
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/practicas/inicio.php',
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => array(
		        "modulorecauda" => trim($algo[0]),
		        "usuario" => trim($algo[1]),
		        "password" => trim($algo[2])
		    )
		));
		$resp = curl_exec($curl);
		$quitarcaracteres =      array('{', '"' , ':', ',', '}', '\'', '[', ']');
		$remplazadocaracteres =  array('/', ''  , '/', '/', '' , ''  , '' , '');
		$limpio = str_replace($quitarcaracteres, $remplazadocaracteres, $resp);
		$porciones = explode("/", $limpio);
		if ($porciones[2]==0) {
			return "No hay Session";
		}
		else{
			return( $porciones[6] );
		}
		// Close request to clear up some resources
		curl_close($curl);
    }

    public function AddCancelacionDB($Transaccion,$session,$TransaccionKiosco){
    	$data = array(
    		'Cancelacion' => $Transaccion,
    		'IdSession' => $session
    		);
    	$this->db->where('idTransaccion',$TransaccionKiosco);
    	$this->db->update('Transaccion', $data);
		return true;
    }

    public function ObtenerOficina(){
    	//URL PRODUCCION 
    	$url = 'http://morelos.morelia.gob.mx:85/kiosco/oficinas.php';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$resp = curl_exec($ch);
		//echo ($resp);
		$quitarcaracteres =      array('{"estatus":0,"respuesta":"[', '{', '},', '\'', '}]","sesion":""}' );
		$remplazadocaracteres =  array('', '/', '', '');
		$limpio = str_replace($quitarcaracteres, $remplazadocaracteres, $resp);
		$porciones = explode("/", $limpio);
		
		return $porciones;
		
		// Close request to clear up some resources
		curl_close($ch);
    }
    public function Predialbusqueda($LocPredio,$TipPredio,$NumPredio,$Apellido,$sesion){
    	// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		//http://morelos.morelia.gob.mx:85/kiosco/busqueda.php?oficina=3008&tipo=2&numpredio=3474&paterno=PEREZ&sesion=a173c40752f64739fdbd1e6141c8a49d
		//URL Produccion http://morelos.morelia.gob.mx:85/kiosco/busqueda.php
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/practicas/busqueda.php',
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => array(
		        "oficina" => $LocPredio,
		        "tipo" => $TipPredio,
		        "numpredio" => $NumPredio,
		        "paterno" => $Apellido,
		        "sesion" => $sesion
		    )
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// $quitarcaracteres =      array('{', '"' , ':', '', '}', '\'', '[', ']');
		// $remplazadocaracteres =  array('/', ''  , '/', '', '' , '/'  , '' , '');
		// $limpio = str_replace($quitarcaracteres, $remplazadocaracteres, $resp);
		// $porciones = explode("/", $limpio);
		// // $arrayfinal= json_decode($resp, true);
		// function array_delete($array, $element) {
		//     return array_diff($array, [$element]);
		// }
		// //$arrayfinal= ($resp);
		//  return ( array_values(array_delete( $porciones, '' )));
		$quitarcaracteres =      array('{', '[', ']', '}');
		$remplazadocaracteres =  array('' , '' , '' , '');
		$Resultado = (str_replace($quitarcaracteres, $remplazadocaracteres, (preg_split("/,'/",$resp)) ) );
		// return $Resultado;
		if (strpos($Resultado[0], 'estatus":0,') or strpos($Resultado[0], 'estatus":"10",')) {
	    	return "No hay parametros";
		}
		else{
		    return $Resultado;
		}
		// Close request to clear up some resources
		curl_close($curl);
    }

    public function RegistraCobro($oficina, $tippredio, $numpredio, $montoadeudo, $session ){
  		//   	// Get cURL resource
		$curl = curl_init();
		// url produccion http://morelos.morelia.gob.mx:85/kiosco/cobrar.php
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/practicas/cobrar.php',
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => array(
		        "oficina" => $oficina,
		        "tipo" => $tippredio,
		        "numpredio" => $numpredio,
		        "sesion" => $session,
		        "montoadeudo" => $montoadeudo,
		        "montoefectivo" => $montoadeudo,
		        "montotarjeta" => "0",
		        "numtransferenciatarjeta" => "0",
		        "bancotarjeta" => ""
		    )
		));
		// Send the request & save response to $resp $result = curl_exec($ch);
		 // $resp = curl_exec($curl);
		$resp = "[{'estatus':1,'respuesta':'INFORMACION ACTUALIZADA','numerodetransaccion':52,'cuentapredial':'101-1-1437','oficinadecobro':'Kiosco','fechadecobro':'18/01/2016 10:15','propietario':'HERNANDEZ GARNICA RODOLFO','ubicacion':'JUAN BARRAGAN S/N,L 29 MZ 27, AGUSTIN ARRIAGA RIVERA','domicilio':'COBALTO 867,L 29 MZ 27, INDUSTRIAL CP 58130','conceptopredial':'PREDIAL, Pago desde:2016-1 al 2016-6','recibopredial':1,'adeudopredial':'10.0','conceptobaldios':'LOTES, Pago desde:2016-1 al 2016-6','recibobaldios':2,'adeudobaldios':'10.0','conceptodap':'DAP, Pago desde:2016-1 al 2016-6','recibodap':3,'adeudodap':'0.0','conceptoisai':'ISAI, Pago desde:2016-1 al 2016-6','reciboisai':4,'adeudoisai':'10.0','montocobrado':'584.00','cantidadletra':'(QUINIENTOS OCHENTA Y CUATRO PESOS 00/100 M. N.)','formadepago':'Efectivo: $584.00','cajerocobro':'KIOSCO','observaciones':'','notainformativa':'SU NUEVA CUENTA PREDIAL ES:1-101-1-1437','cadenaverificacion':''}]" ;
		// 																																																																															PREDIAL, Pago desde:2016-1 al 2016-6
		// $resp = "'estatus':1 [1] => respuesta':'INFORMACION ACTUALIZADA' [2] => numerodetransaccion':45 [3] => cuentapredial':'101-1-1293' [4] => oficinadecobro':'Kiosco' [5] => fechadecobro':'18/01/2016 09:36' [6] => propietario':'AVALOS GARCIA MARIA MONICA' [7] => ubicacion':'JOSE MARIA G HERMOSILLO 89,RESTO L 13 MZ 20, AGUSTIN ARRIAGA RIVERA' [8] => domicilio':'JOSE MARIA G HERMOSILLO 89,RESTO L 13 MZ 20, AGUSTIN ARRIAGA RIVERA CP 58190' 
		//[9] => conceptopredial':'PREDIAL, Pago desde:2016-1 al 2016-6' 
		//[10] => recibopredial':5974057 
		//[11] => adeudopredial':'877.00' 
		// [12] => conceptobaldios':'' 
		// [13] => recibobaldios':0 
		// [14] => adeudobaldios':'0' 
		// [15] => conceptodap':'DAP, Pago desde:2015-1 al 2016-6' 
		// [16] => recibodap':5974058 [17] => adeudodap':'286.00' 
		// [18] => conceptoisai':'' [19] => reciboisai':0 
		// [20] => adeudoisai':'0' [21] => montocobrado':'1,163.00' 
		// [22] => cantidadletra':'(MIL CIENTO SESENTA Y TRES PESOS 00/100 M. N.)' 
		// [23] => formadepago':'Efectivo: $1,163.00' 
		// [24] => cajerocobro':'KIOSCO' 
		// [25] => observaciones':'' 
		// [26] => notainformativa':'SU NUEVA CUENTA PREDIAL ES:1-101-1-1293' 
		// [27] => cadenaverificacion':''";
		$quitarcaracteres =      array('{', '[', ']', '}');
        $remplazadocaracteres =  array('' , '' , '' , '');
        $Resultado = (str_replace($quitarcaracteres, $remplazadocaracteres, (preg_split("/,'/",$resp)) ) );
		// print_r("<pre>");
		// print_r($Resultado['0']);
		// print_r("</pre>");
		// var_dump(($resp));
		return $Resultado;
		
		// if ($Resultado['0'] == "'estatus':1") {
	  //           print_r("SI");
	  //       }
	  //       else {
	  //           print_r("NO");
	  //       }

		// Close request to clear up some resources
		curl_close($curl);
    }

}

