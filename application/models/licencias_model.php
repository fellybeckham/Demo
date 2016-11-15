<?php

class Licencias_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
    }

    public function inicioSession() {
        Licencias::logSW("Llama al metodo para iniciar sesion.");
        $file = fopen("Oficina.txt", "r");
        while (!feof($file)) {
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
        $quitarcaracteres = array('{', '"', ':', ',', '}', '\'', '[', ']');
        $remplazadocaracteres = array('/', '', '/', '/', '', '', '', '');
        $limpio = str_replace($quitarcaracteres, $remplazadocaracteres, $resp);
        $porciones = explode("/", $limpio);
        if ($porciones[2] == 0) {
            Licencias::logSW("No se pudo obtener la sesión.");
            return "No hay Session";
        } else {
            Licencias::logSW("Sesion iniciada. Resultado " . $porciones[6]);
            return( $porciones[6] );
        }
        // Close request to clear up some resources
        curl_close($curl);
    }

    public function Aguabusqueda($CodBarra, $NumeroContrato, $NexTer, $sesion) {
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

    public function RegistraCobro($importetotal, $numerocontrato, $session) {
        $importetotal = str_replace(',', '', $importetotal);
        $file = fopen("kiosko.txt", "r"); //Se obtiene los datos de sesion
        while (!feof($file)) {
            $algo[] = fgets($file); //Se guardan en un array
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

    /* public function RegistraCobroprueba(){
      $Resultado = '{"estatus":"1","respuesta":"COBRO VALIDO","propietario":"VILLELA CRISTINA","numerocontrato":"003652","domicilio":"EDUARDO RUIZ NO. 672 COL. CENTRO","concepto":"COBRO DE RECIBO AGUA OOAPAS.","fechacobro":"09-05-2016 08:36:40","cantidadletra":"novecientos treinta y un pesos 00\/100 M.N.","cadenaverificacion":"880036529019175615","montocobrado":"$931.00","codigobarra":"77003652080416000000009317","id_kiosko":"1"}';
      $Resultado = (array) json_decode($Resultado);
      return $Resultado;
      //$resp = "[{'estatus':1,'respuesta':'INFORMACION ACTUALIZADA','numerodetransaccion':52,'cuentapredial':'101-1-1437','oficinadecobro':'Kiosco','fechadecobro':'18/01/2016 10:15','propietario':'HERNANDEZ GARNICA RODOLFO','ubicacion':'JUAN BARRAGAN S/N,L 29 MZ 27, AGUSTIN ARRIAGA RIVERA','domicilio':'COBALTO 867,L 29 MZ 27, INDUSTRIAL CP 58130','conceptopredial':'PREDIAL, Pago desde:2016-1 al 2016-6','recibopredial':1,'adeudopredial':'10.0','conceptobaldios':'LOTES, Pago desde:2016-1 al 2016-6','recibobaldios':2,'adeudobaldios':'10.0','conceptodap':'DAP, Pago desde:2016-1 al 2016-6','recibodap':3,'adeudodap':'0.0','conceptoisai':'ISAI, Pago desde:2016-1 al 2016-6','reciboisai':4,'adeudoisai':'10.0','montocobrado':'584.00','cantidadletra':'(QUINIENTOS OCHENTA Y CUATRO PESOS 00/100 M. N.)','formadepago':'Efectivo: $584.00','cajerocobro':'KIOSCO','observaciones':'','notainformativa':'SU NUEVA CUENTA PREDIAL ES:1-101-1-1437','cadenaverificacion':''}]" ;

      } */
    /* $paterno, $materno, $nombre, $numtelefono, $email, $giro, $establecimiento, $calle, $numext, $colonia, $codpostal, $calle1, $calle2, $numempleos, $Investimada, */

    public function imprimirSolicitudApertura($data) {
        Licencias::logSW("Entra a metodo para obtener y descargar el pdf.");
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/practicas/CapturaApertura.php',
                CURLOPT_USERAGENT => 'Codular Sample cURL Request',
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => array(
                    "paterno" => $data['paterno'],
                    "materno" => $data['materno'],
                    "nombre" => $data['nombre'],
                    "numtelefono" => $data['numtelefono'],
                    "email" => $data['email'],
                    "giro" => $data['giro'],
                    "girocomple" => $data['girocomple'],
                    "establecimiento" => $data['establecimiento'],
                    "calle" => $data['calle'],
                    "numext" => $data['numext'],
                    "colonia" => $data['colonia'],
                    "codpostal" => $data['codpostal'],
                    "calle1" => $data['calle1'],
                    "calle2" => $data['calle2'],
                    "numempleos" => $data['numempleos'],
                    "investimada" => $data['Investimada'],
                    "sesion" => $data['sesion']
                )
            ));

       // $resp = curl_exec($curl);
//        header('Content-type: application/pdf');
//        echo $resp;
////var_dump($resp);
//        curl_close($curl);
            $fp = fopen('archivo.pdf', 'w');
            curl_setopt($curl, CURLOPT_FILE, $fp);
            curl_exec($curl);
//        header('Content-type: application/pdf');
////        $name = 'archivo.pdf';
////force_download($name, $resp);
//        echo $resp;
            curl_close($curl);
//        $output_filename ="prueba.pdf";
//        $fp = fopen($output_filename, 'w');
//    fwrite($fp, $resp);
            fclose($fp);
            Licencias::logSW("El archivo pdf fue descargado correctamente. ");
            return "OK";
        } catch (Exception $ex) {
            Licencias::logSW("Error al descargar el pdf. ".$ex);
           return "ERROR";
        }
    }

    public function obtenergiros($sesion) {
        //echo $sesion;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/practicas/filtrodegiros.php',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                "sesion" => $sesion
            )
        ));

        $resp = curl_exec($curl);
        $resp = str_replace("'", '"', $resp);
        //var_dump($resp);

        Licencias::logSW("Se consulto el metodo para obtener los giros. ".$resp);
        return $resp;
//var_dump($resp);
        curl_close($curl);
    }

    /////////////****************** CONSULTAS PARA LA REVALIDACION DE LICENCIAS **************/
    public function obtenerTipoLicencias($sesion) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/practicas/TiposdeLicencias.php',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                "sesion" => $sesion
            )
        ));

        $resp = curl_exec($curl);
        $resp = str_replace("'", '"', $resp);
        Licencias::logSW("Se consulto el metodo para obtener los tipos de licencia.".$resp);
        return $resp;
        //var_dump($resp);
        curl_close($curl);
    }

    public function obtenerLicencia($session, $noLicencia, $tipoLicencia, $apPaterno) {
        //echo $sesion;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://morelos.morelia.gob.mx:85/kiosco/practicas/BusquedaLicencia.php',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                "licencia" => $noLicencia,
                "genero" => $tipoLicencia,
                "paterno" => $apPaterno,
                "sesion" => $session
            )
        ));

        $resp = curl_exec($curl);
        $resp = str_replace("'", '"', $resp);
        Licencias::logSW("Se conulto el metodo para obtener la licencia No".$noLicencia. ". Resp: ".$resp);
        return $resp;
//        var_dump($resp);
        curl_close($curl);
    }

}
