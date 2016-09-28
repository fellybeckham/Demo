<?php

class Opagos_model extends CI_Model {

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
		// $resp = "[{'estatus':1,'respuesta':'TODO%20BIEN','sesion':'7gjricmccg6ckie8b5g05f5j46'}]";
		$this->logSW("Modelo- Resultado inicio sesion: ".var_export($resp,true));
		$quitarcaracteres =      array('{', '"' , ':', ',', '}', '\'', '[', ']');
		$remplazadocaracteres =  array('/', ''  , '/', '/', '' , ''  , '' , '');
		$limpio = str_replace($quitarcaracteres, $remplazadocaracteres, $resp);
		$porciones = explode("/", $limpio);
		if ($porciones[2]==0 or count($porciones)<=6) {
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
    
    public function Getingresos($idSession){
    	$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/practicas/filtraotrosingresos.php',
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		    CURLOPT_POST => 1,
		    CURLOPT_HTTPHEADER => array('application/json'),
		    CURLOPT_POSTFIELDS => array(
		        // "elid" => $idSession
		        //97nobotb6e888nde1mj62ls3u6
		        "elid" => $idSession
		        // "usuario" => "kioscoesol",
		        // "password" =>"estrasol"
		    )
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// $this->logSW("Modelo- Resultado Get ingresos: ".var_export($resp,true));
		curl_close($curl);
		$quitarcaracteres =      array('[',']','{' );
		$remplazadocaracteres =  array('');
		$limpio = str_replace($quitarcaracteres, $remplazadocaracteres, $resp);
		$porciones = explode("},", $limpio);
		return $porciones;
    }

    public function opagos_busqueda($tipoadeudo, $folio, $paterno, $session){
    	$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/practicas/busquedaotrospagos.php',
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => array(
		        "tipoadeudo" => trim($tipoadeudo),
		        "Folio" => trim($folio),
		        "paterno" => trim($paterno),
		        "sesion" => trim($session)
		    )
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		$this->logSW("Modelo- Resultado busqueda otros pagos: ".var_export($resp,true));
		curl_close($curl);
		
		$resp = utf8_encode(urldecode($resp));
		$quitarcaracteres =      array('{', '[', ']', '}', ',\'');
		$remplazadocaracteres =  array('' , '' , '' , '', 'æ');
		$limpio = str_replace($quitarcaracteres, $remplazadocaracteres, $resp);
		$porciones = explode("æ", $limpio);
		if (strpos($porciones[0], 'estatus":0,') or strpos($porciones[0], 'estatus":"10",')) {
	    	return "No hay parametros";
		}
		else{
			return $porciones;
		}
    	//return "[{'estatus':1,'respuesta':'INFORMACION%20ENCONTRADA','concepto':'LICENCIAS%20MPALES.','nota':'Referencia:LICFUN-724216%20Cta.%20Predial:101-1-999999 Licencia%2050297%20-%20B','propietario':'FERREYRA%20FRAGA%20FROYLAN','ubicacion':'BEGONIA%2061%20AMPLIACION%20%20EL%20PORVENIR%20S/N%20%20ENTRE%20CALLE(S):%20DALIA,%20GLADIOLA,%20CP:0','domicilio':'LOMA%20ESCONDIDA%20249%20,%20INFONAVIT%20LOMAS%20DEL%20VALLE,%20CP:58170','totaladeudo':'817.00','noprop':50050,'genero':'','conceptos':'DICTAMEN%20(PROTECCION%20CIVIL)%20ESTABLECIMIENTOS%20HASTA%2075%20M�.%20BAJO%20G.P%20$%20451.39%20|%20DICTAMEN%20PROTECCION%20AL%20MEDIO%20AMBIENTE%20LIC.TIPO%20B%20$%20365.20%20|%20OTROS%20NO%20ESPECIFICADOS(CARGOS%20POR%20REDONDEO)%20$%200.4100','rfc':''}]";
    }

    public function RegistraPago($tipoadeudo,$folio,$sesion,$montoadeudo){
    	// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/practicas/cobrarotrospagos.php',
	    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => array(
	        "tipoadeudo" => $tipoadeudo,
	        "folio" =>$folio,
	        "montoadeudo" => $montoadeudo,
	        "montoefectivo" => $montoadeudo,
	        "montotarjeta" => "0",
	        "numtransferenciatarjeta" => "",
	        "bancotarjeta" => "",
	        "sesion" => $sesion
		    )
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		$this->logSW("Modelo- Resultado Registra PAgo: ".var_export($resp,true));
		// Close request to clear up some resources
		curl_close($curl);
		// $resp = "[{'estatus':1,'respuesta':'INFORMACION ACTUALIZADA','numerodetransaccion':1172,'folio':'Solicitud: 434916','oficinadecobro':'Kiosco Mpal.','fechadecobro':'31/05/2016 10:08','propietario':'PIÃ‘ON MENDOZA LAZARO','ubicacion':'','domicilio':'JOSE MARIA MORELOS 595 , SANTIAGO UNDAMEO','observaciones':'No. Folio 434916 Cta. predial: 103-1-353  PRESENTA SENTENCIA DEFINITIVA DE JUICIO CIVIL EXPEDIENTE 914/2013','notainformativa':'','cadenaverificacion':'','concepto':'TRAMITES SDUMA','recibo':6261824,'montocobrado':'129.00','losconceptos':'CONSTANCIA DE NÚMERO OFICIAL $ 128.75 | OTROS NO ESPECIFICADOS(CARGOS POR REDONDEO) $ 0.25','cantidadletra':'(CIENTO VEINTINUEVE PESOS 00/100 M. N.)','formadepago':'Efectivo: $129.00','cajerocobro':'KIOSCOESOL','notransaccion':369489}]";
    	// $resp = "[{'estatus':1,'respuesta':'INFORMACION ACTUALIZADA','numerodetransaccion':153,'folio':'Num. de Infraccion: 145691','oficinadecobro':'Kiosco Mpal.','fechadecobro':'15/04/2016 16:57','propietario':'REYES GARIBAY JUAN JOSE','ubicacion':'ACUEDUCTO , CENTRO','domicilio':'','observaciones':'No. Folio 145691 NO. PLACA: PSZ2854, Fec. Infracc:11/03/2016','notainformativa':'NOTA IMPORTANTE DE SU CUENTA ALGO MAS IMPORTANTE','cadenaverificacion':'23476123','concepto':'TRANSITO','recibo':6261698,'montocobrado':'2,191.00','losconceptos':'CONDUCIR VEHICULO AUTOMOTOR BAJO EL INFLUJO DE ALCOHOL Y/O DROGAS, GRADO ALCOHOLEMIA 0.60 MG/L O MAS $ 2,191.20 | OTROS NO ESPECIFICADOS(CARGOS POR REDONDEO) $ -0.20','cantidadletra':'(DOS MIL CIENTO NOVENTA UN PESOS 00/100 M. N.)','formadepago':'Efectivo: $2,191.00','cajerocobro':'KIOSCOESOL','notransaccion':371060}]";
    	// $resp = "[{'estatus':1,'respuesta':'INFORMACION ACTUALIZADA','numerodetransaccion':1162,'folio':'Solicitud: 425016','oficinadecobro':'Kiosco Mpal.','fechadecobro':'25/05/2016 13:14','propietario':'PERIFCO. PASEO DE LA REPUBLICA 5996 BUENA VISTA S/N ENTRE CALLE(S): JUAN DE BAEZA, FRAY SEBASTIAN DE APARICIO, CP:0','ubicacion':'PERIFCO. PASEO DE LA REPUBLICA 5996 BUENA VISTA S/N ENTRE CALLE(S): JUAN DE BAEZA, FRAY SEBASTIAN DE APARICIO, CP:0','domicilio':'OCOLUSEN 177 , POBLADO OCOLUSEN','observaciones':'No. Folio 425016 Cta. predial: 101-1-374390  DEPARTAMENTO DE INTERES SOCIAL SEGUNDO NIVEL CON CAJON DE ESTACIONAMIENTO DESCUBIERTO DOCUMENTACION ANEXADA EN FOLIO N° 406916','notainformativa':'','cadenaverificacion':'','concepto':'ORDENES DE ENTERO','recibo':6261789,'montocobrado':'660.00','losconceptos':'LIC. DE CONSTRUCC. ESTACIONAMIENTOS ABIERTOS $ 18.00 | LIC. DE CONSTRUCC. VIVIENDA INTERES SOCIAL DE 91M2 EN ADELANTE $ 642.06 | OTROS NO ESPECIFICADOS(CARGOS POR REDONDEO) $ -0.06','cantidadletra':'(SEISCIENTOS SESENTA PESOS 00/100 M. N.)','formadepago':'Efectivo: $660.00','cajerocobro':'KIOSCOESOL','notransaccion':368747}]";
    	// $resp = '{"estatus":2,"respuesta":"no se pasaron parametros necesarios: Estos Parametros no Existen , El Folio\/Solicitud\/Infraccion\/Orden, Falta la variable sesion","sesion":""}';
    	// $resp = "[{'estatus':1,'respuesta':'INFORMACION ACTUALIZADA','numerodetransaccion':1148,'folio':'Solicitud: 723416','oficinadecobro':'Kiosco Mpal.','fechadecobro':'17/05/2016 11:23','propietario':'BORJA SEGUNDO EDUARDO','ubicacion':'PATRIOTISMO 106-A COL. MOLINO DE PARRAS S/N ENTRE CALLE(S): AVENIDA SOLIDARIDAD, ALIANZA, CP:0','domicilio':'PATRIOTISMO 106 , MOLINO DE PARRAS, CP:58010','observaciones':'No. Folio 723416 Cta. predial: 101-1-999999 Licencia 24847 - B','notainformativa':'','cadenaverificacion':'','concepto':'LICENCIAS MPALES.','recibo':6261720,'montocobrado':'2,191.00','losconceptos':'DICTAMEN (PROTECCION CIVIL) ESTABLECIMIENTOS HASTA 75 M². BAJO G.P $ 451.39 | OTROS NO ESPECIFICADOS(CARGOS POR REDONDEO) $ -0.39','cantidadletra':'(DOS MIL CIENTO NOVENTA UN PESOS 00/100 M. N.)','formadepago':'Efectivo: $2,191.00','cajerocobro':'KIOSCOESOL','notransaccion':365366}]";
		$resp = utf8_encode(urldecode($resp));
    	$quitarcaracteres =      array('{', '[', ']', '}');
        $remplazadocaracteres =  array('' , '' , '' , '');
        $Resultado = (str_replace($quitarcaracteres, $remplazadocaracteres, (preg_split("/,'/",$resp)) ) );
    	if (strpos($Resultado[0], 'estatus":2,') or strpos($Resultado[0], 'estatus":"0",') or strpos($Resultado[0], "'restransaccion':0,")) {
	    	return "No hay parametros";
		}
		else{
			return $Resultado;
		}
    }

    function logSW($cadena){
        try {
            $direcion = APPPATH."/logs/OPAGOS/";
            $control = fopen($direcion."LogsServicios-".date('d-m-Y').".log","a+");
            if($control == true){
                fwrite($control,date('d/m/Y h:i:s ')."  ".$cadena. PHP_EOL);
                fclose($control);
            }
        } catch (Exception $e) {}        
    }
//fin class
}

