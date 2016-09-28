<?php

class Licencias_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
    }

    public function inicioSession(){
    	//Leer archivo kiosko
		$file = fopen("kiosko.txt", "r");//Se obtiene los datos de sesion
		while(!feof($file)) {
		 $algo[] = fgets($file);//Se guardan en un array
		}
		fclose($file);
		$curl = curl_init();
		//URL PRODUCCION 
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/ooapas/inicio.php',
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => array(
		        "kiosko" => trim($algo[0]),
		        "usuario" => trim($algo[1]),
		        "clave" => trim($algo[2])
		    )
		));
		$resp = curl_exec($curl);
		
		$resp = (array) json_decode($resp);
		
		return $resp;
		
		// Close request to clear up some resources
		curl_close($curl);
    }

   
    public function Aguabusqueda($CodBarra,$NumeroContrato,$NexTer,$sesion){
    	// Get cURL resource
		$curl = curl_init();

		//
		//http://morelos.morelia.gob.mx:85/kiosco/ooapas/busqueda.php
		//URL Produccion http://morelos.morelia.gob.mx:85/kiosco/busqueda.php
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/ooapas/busqueda.php',
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => array(
		        "numerocontrato" => $NumeroContrato,
		        "nexter" => $NexTer,
		        "codbarra" => $CodBarra,		     
		        "sesion" => $sesion
		    )
		));
		
		$resp = curl_exec($curl);
		
		$resp = (array) json_decode($resp);
		return $resp;
		
		curl_close($curl);
    }

    public function RegistraCobro($importetotal, $numerocontrato, $session){
    	$importetotal = str_replace(',', '', $importetotal); 
  		$file = fopen("kiosko.txt", "r");//Se obtiene los datos de sesion
		while(!feof($file)) {
		 $algo[] = fgets($file);//Se guardan en un array
		}
		fclose($file);
		trim($algo[0]);
		$curl = curl_init();
		// url produccion 
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/ooapas/cobrar.php',
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => array(
		        "importetotal" => $importetotal,
		        "numerocontrato" => $numerocontrato,
		        "kiosko" => trim($algo[0]),
		        "sesion" => $session  
		    )
		));
		// Send the request & save response to $resp $result = curl_exec($ch);
		$resp = curl_exec($curl);
		//$resp = "[{'estatus':1,'respuesta':'INFORMACION ACTUALIZADA','numerodetransaccion':52,'cuentapredial':'101-1-1437','oficinadecobro':'Kiosco','fechadecobro':'18/01/2016 10:15','propietario':'HERNANDEZ GARNICA RODOLFO','ubicacion':'JUAN BARRAGAN S/N,L 29 MZ 27, AGUSTIN ARRIAGA RIVERA','domicilio':'COBALTO 867,L 29 MZ 27, INDUSTRIAL CP 58130','conceptopredial':'PREDIAL, Pago desde:2016-1 al 2016-6','recibopredial':1,'adeudopredial':'10.0','conceptobaldios':'LOTES, Pago desde:2016-1 al 2016-6','recibobaldios':2,'adeudobaldios':'10.0','conceptodap':'DAP, Pago desde:2016-1 al 2016-6','recibodap':3,'adeudodap':'0.0','conceptoisai':'ISAI, Pago desde:2016-1 al 2016-6','reciboisai':4,'adeudoisai':'10.0','montocobrado':'584.00','cantidadletra':'(QUINIENTOS OCHENTA Y CUATRO PESOS 00/100 M. N.)','formadepago':'Efectivo: $584.00','cajerocobro':'KIOSCO','observaciones':'','notainformativa':'SU NUEVA CUENTA PREDIAL ES:1-101-1-1437','cadenaverificacion':''}]" ;
		$resp = (array) json_decode($resp);																																																																														
		return $resp;
		
		curl_close($curl);
    }
	/*public function RegistraCobroprueba(){
  		$Resultado = '{"estatus":"1","respuesta":"COBRO VALIDO","propietario":"VILLELA CRISTINA","numerocontrato":"003652","domicilio":"EDUARDO RUIZ NO. 672 COL. CENTRO","concepto":"COBRO DE RECIBO AGUA OOAPAS.","fechacobro":"09-05-2016 08:36:40","cantidadletra":"novecientos treinta y un pesos 00\/100 M.N.","cadenaverificacion":"880036529019175615","montocobrado":"$931.00","codigobarra":"77003652080416000000009317","id_kiosko":"1"}';
        $Resultado = (array) json_decode($Resultado);
        return $Resultado;     
		//$resp = "[{'estatus':1,'respuesta':'INFORMACION ACTUALIZADA','numerodetransaccion':52,'cuentapredial':'101-1-1437','oficinadecobro':'Kiosco','fechadecobro':'18/01/2016 10:15','propietario':'HERNANDEZ GARNICA RODOLFO','ubicacion':'JUAN BARRAGAN S/N,L 29 MZ 27, AGUSTIN ARRIAGA RIVERA','domicilio':'COBALTO 867,L 29 MZ 27, INDUSTRIAL CP 58130','conceptopredial':'PREDIAL, Pago desde:2016-1 al 2016-6','recibopredial':1,'adeudopredial':'10.0','conceptobaldios':'LOTES, Pago desde:2016-1 al 2016-6','recibobaldios':2,'adeudobaldios':'10.0','conceptodap':'DAP, Pago desde:2016-1 al 2016-6','recibodap':3,'adeudodap':'0.0','conceptoisai':'ISAI, Pago desde:2016-1 al 2016-6','reciboisai':4,'adeudoisai':'10.0','montocobrado':'584.00','cantidadletra':'(QUINIENTOS OCHENTA Y CUATRO PESOS 00/100 M. N.)','formadepago':'Efectivo: $584.00','cajerocobro':'KIOSCO','observaciones':'','notainformativa':'SU NUEVA CUENTA PREDIAL ES:1-101-1-1437','cadenaverificacion':''}]" ;
		
    }*/
      

}

