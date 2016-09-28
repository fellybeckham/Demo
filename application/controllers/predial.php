<?php
error_reporting(0);
require_once APPPATH."/third_party/fpdf/code128.php";
class Predial extends CI_Controller{

    private $data;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('predial_model');
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session'));
        // $this->data['breadcrumb'] = 'breadcrumb_curp.jpg';
    }
    
    public function index() {
        $data['session']= $this->predial_model->inicioSession();
        $data['Oficinas']= $this->predial_model->ObtenerOficina();
        // $data['session'] = $this->input->post('sesion');
        $data['localizacion'] = "";
        $data['tipo'] = "";
        $data['Numero'] = "";
        $data['Apellido'] = "";
        $data['MensajeError'] = "";
        $data['MensajeAudio'] = "";
        $this->logSW("Obtiene Session y Oficinas");
        if ($data['session']=='No hay Session') {
            $this->logSW("metodo ErrorServer- Error en Servidor");
            $datas['Error'] = "NoSession";
            $data['vista'] = $this->load->view('frmErrorServicio.php', $datas, TRUE); //True para pasar la vista como dato
            $this->load->view('templates/layout', $data);
        }
        else{
            $data['vista'] = $this->load->view('predial/index.php',$data, TRUE); //True para pasar la vista como dato
            $this->load->view('templates/layout', $data);
        }
        
    }

    public function RegresarPredial(){
        //datos correctos
        $locpredio = $this->input->post('oficina');
        $tippredio = $this->input->post('tipo');
        $numpredio = $this->input->post('numpredio');
        $apellido = $this->input->post('Apellido');
        $session = $this->input->post('sesion');
        
        $Resultado = $this->predial_model->Predialbusqueda($locpredio,$tippredio,$numpredio,$apellido,$session);
        $this->logSW("metodo RegresarPredial()".var_export($Resultado, true));
        $data['Enviados'] = $session;
        $data['DatosBusqueda'] = $Resultado;
        $data['Apellido'] = $this->input->post('Apellido');

        $data['vista'] = $this->load->view('predial/Buscado.php',$data, TRUE); //True para pasar la vista como dato
        $this->load->view('templates/layout', $data);
    }

    public function buscarPredial(){
        $data['Oficinas']= $this->predial_model->ObtenerOficina();
        //validaciones
        $this->form_validation->set_rules('LocPredio', 'LocPredio', 'required');
        $this->form_validation->set_rules('TipPredio', 'TipPredio', 'required');
        $this->form_validation->set_rules('NumPredio', 'NumPredio', 'required');
        $this->form_validation->set_rules('Apellido', 'Apellido', 'required');
        //Mensajes
        // %s es el nombre del campo que ha fallado
        $this->form_validation->set_message('required','Este dato es obligatorio');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if($this->form_validation->run() === true){
            //datos correctos
            $locpredio = $this->input->post('LocPredio');
            $tippredio = $this->input->post('TipPredio');
            $numpredio = $this->input->post('NumPredio');
            $apellido = $this->input->post('Apellido');
            $session = $this->input->post('sesion');
                
            $Resultado = $this->predial_model->Predialbusqueda($locpredio,$tippredio,$numpredio,$apellido,$session);
            $this->logSW("Resultado Busqueda: ".var_export($Resultado,true));
            if ($Resultado == "No hay parametros") {
                $data['session'] = $this->input->post('sesion');
                $data['localizacion'] = $this->input->post('LocPredio');
                $data['tipo'] = $this->input->post('TipPredio');
                $data['Numero'] = $this->input->post('NumPredio');
                $data['Apellido'] = $this->input->post('Apellido');
                $data['MensajeError'] = "No existe Registro";
                $data['MensajeAudio'] = "<script type='text/javascript'>window.external.reproducirAudio('6')</script>";
                $this->logSW("metodo buscarPredial No encontro Resultado");
                $data['vista'] = $this->load->view('predial/index.php', $data, TRUE); //True para pasar la vista como dato
                $this->load->view('templates/layout', $data);    
            }
            else{
                $this->logSW("metodo buscarPredial Si se encontro Los datos de busqueda");
                $data['Enviados'] = $session;
                $data['DatosBusqueda'] = $Resultado;
                $data['Apellido'] = $this->input->post('Apellido');
                $data['vista'] = $this->load->view('predial/Buscado.php',$data, TRUE); //True para pasar la vista como dato
                $this->load->view('templates/layout', $data);
            }
        }
        else{
            //datos incorrectos
            $data['session'] = $this->input->post('sesion');
            $data['localizacion'] = $this->input->post('LocPredio');
            $data['tipo'] = $this->input->post('TipPredio');
            $data['Numero'] = $this->input->post('NumPredio');
            $data['Apellido'] = $this->input->post('Apellido');
            $this->logSW("metodo buscarPredial Datos Incorrectos de busqueda no paso validacion");
            $data['vista'] = $this->load->view('predial/index.php', $data, TRUE); //True para pasar la vista como dato
            $this->load->view('templates/layout', $data);
        }

    }
    
    public function pago(){       
        //datos para pago
        $data['oficina'] = $this->input->post('oficina');
        $data['tippredio'] = $this->input->post('tipo');
        $data['numpredio'] = $this->input->post('numpredio');
        $data['Apellido'] = $this->input->post('Apellido');
        $data['montoadeudo'] = $this->input->post('montoadeudo');
        $data['session'] = $this->input->post('sesion');
        $this->logSW("Paso pantalla de  pago, Pagara".var_export($this->input->post('montoadeudo'), true));
        $this->data['vista'] = $this->load->view('share/pago', $data, TRUE);
        $this->load->view('templates/layout', $this->data);        
    } 

    public function vendingcobrar(){           
        array_walk($_GET , array($this, 'filtro'));
        $this->load->view('predial/vending', true);             
    } 

    public function filtro(&$value){
        $value = trim(utf8_encode($value));
    } 

    public function RegistraPago(){
        //datos para pago
        $oficina = $this->input->get('OFICINA');
        $tippredio = $this->input->get('TIPO');
        $numpredio = $this->input->get('NUMPREDIAL');
        $montoadeudo = $this->input->get('MONTOADEUDO');
        $session = $this->input->get('SESION');

        $Resultado = $this->predial_model->RegistraCobro($oficina,$tippredio,$numpredio,$montoadeudo,$session);
        $this->logSW("Resultado Registro pago: ".var_export($Resultado, true));
        if (trim($Resultado['0']) == "'estatus':1") {
                        
            //Variables de ticket
            $numerodetransaccion = str_replace(["numerodetransaccion':" ,"'"], "", $Resultado['2']);
            $cuentaPredial = str_replace(["cuentapredial':'" ,"'"], "", $Resultado['3']);
            $oficinaRecauda = str_replace(["oficinadecobro':'" ,"'"], "", $Resultado['4']);
            $fechadecobro = str_replace(["fechadecobro':'" ,"'"], "", $Resultado['5']);
            $propietario = str_replace(["propietario':'" ,"'"], "", $Resultado['6']);
            $ubicacion = str_replace(["ubicacion':'" ,"'"], "", $Resultado['7']);
            $domicilio = str_replace(["domicilio':'" ,"'"], "", $Resultado['8']);
            // $this->logSW("UBICACION: ".var_export($ubicacion, true));
            //conceptos y folios
            $conceptopredial = str_replace(["conceptopredial':'" ,"'"], "", $Resultado['9']);
            $recibopredial = str_replace(["recibopredial':" ,"'"], "", $Resultado['10']);
            $importepredial = str_replace(["adeudopredial':'" ,"'"], "", $Resultado['11']);
            $conceptobaldios = str_replace(["conceptobaldios':'" ,"'"], "", $Resultado['12']);
            $recibobaldios = str_replace(["recibobaldios':" ,"'"], "", $Resultado['13']);
            $adeudobaldios = str_replace(["adeudobaldios':'" ,"'"], "", $Resultado['14']);
            $conceptodap = str_replace(["conceptodap':'" ,"'"], "", $Resultado['15']);
            $recibodap = str_replace(["recibodap':" ,"'"], "", $Resultado['16']);
            $adeudodap = str_replace(["adeudodap':'" ,"'"], "", $Resultado['17']);
            $conceptoisai = str_replace(["conceptoisai':'" ,"'"], "", $Resultado['18']);
            $reciboisai = str_replace(["reciboisai':" ,"'"], "", $Resultado['19']);
            $adeudoisai = str_replace(["adeudoisai':'" ,"'"], "", $Resultado['20']);
            $montocobrado = str_replace(["montocobrado':'" ,"'"], "", $Resultado['21']);
            $cantidadletra = str_replace(["cantidadletra':'" ,"'"], "", $Resultado['22']);
            $cajerocobro = str_replace(["cajerocobro':'" ,"'"], "", $Resultado['24']);
            $observaciones = str_replace(["observaciones':'" ,"'"], "", $Resultado['25']);
            $notainformativa = str_replace(["notainformativa':'" ,"'"], "", $Resultado['26']);
            $cadenaverificacion = str_replace(["cadenaverificacion':'" ,"'"], "", $Resultado['27']);
            $notransaccion = str_replace(["notransaccion':'" ,"'"], "", $Resultado['28']);

            $numTran = empty( $_GET['idTransaccion'] )  ? '' : $_GET['idTransaccion'];
            $recibido = empty( $_GET['recibido'] )  ? '0' : $_GET['recibido'];
            $cambio = empty( $_GET['cambio'] )  ? '0' : $_GET['cambio'];

            //$cajero = empty( $_GET['cajero'] )  ? '--' : $_GET['cajero'];
            // $ubicacion = empty( $_GET['ubicacion'] )  ? '--' : $_GET['ubicacion'];
            $idKiosco = empty( $_GET['idKiosco'] )  ? '--' : $_GET['idKiosco'];
            $ccName = empty( $_GET['ccName'] )  ? '--' : $_GET['ccName'];
            $ccNum = empty( $_GET['ccNum'] )  ? '--' : $_GET['ccNum'];
            $NoOperacion = empty( $_GET['NoOperacion'] )  ? '--' : $_GET['NoOperacion'];
            $NoAutorizacion = empty( $_GET['NoAutorizacion'] )  ? '--' : $_GET['NoAutorizacion'];

            // Agregado Campos a DB paar Cancelacion
            $this->logSW("Guarda Datos de Pago: numerodetransaccion-".var_export($numerodetransaccion,ture).' Session-'.var_export($session,true).' IdTransaccion-'.var_export($numTran,true));
            $CancelacionDB = $this->predial_model->AddCancelacionDB($numerodetransaccion,$session,$numTran);

            $cambio = str_replace("?","",$cambio);
            //$cajero = str_replace("?","",$cajero);
            $recibido = str_replace("?","",$recibido);
            $idTransaccion = str_replace("?","",$numTran);
            $ubicacion = str_replace("?","",$ubicacion); 

            $this->logSW("entra a generar ticket.");
            //$this->logSW("Variables de ticket".var_export($Resultado,true));
            $tran=$_GET["idTransaccion"];
            global $coluY;
            global $cellX;
            global $cellY;
            global $tipfuente;
            global $fuentetit;
            global $fuentesubt;
            global $fuentetex;
            $coluY=13;
            $cellX=67;
            $cellY=8;
            $fuentetit=18;
            $fuentesubt=11;
            $fuentetex=9;
            $tipfuente='Arial';
        
            //se agregar 17/07/2015
            $lineX1=28;
            $lineX3=54;
            $lineXC=11;
            $lineX2=26;
            $posiX=2;

            $tipoPag="EFECTIVO";
            $tpago="E";
            //if($tpago=="E")
            //{ $tipoPag="EFECTIVO";}
            //else if($tpago=="T")
            //{ $tipoPag="TARJETA";}    
            //else $tipoPag="OTRO";
            //
            //if($tpago=="E")
            //{$total=ceil($total);
            //}

            $observacionessize = strlen($observaciones);
            $observaciones=strtoupper ($observaciones);
            $oficinaRecauda=strtoupper ($oficinaRecauda);
            $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
            $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"); 
            
            $fecha_act=  $week_days[date ("w")].' '. date ( 'd' ).' de '.$months[ date ("n")].' de '.date('Y').' '.date('h').':'.date('i').' Hrs' ;
            // $ticket2="tiket2.pdf";
            
            require_once APPPATH."/third_party/fpdf/code128.php";
            
            $pdf=new PDF_Code128();
            $pdf->AddPage();
            
            //Encabezado
            $pdf->Image('img\Tickets.png',2,5,65);
            $coluY=$coluY+2;//22
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',8);
            $pdf->Cell($cellX,$cellY,'',10,10,'C');
            
            $coluY=$coluY+43;//22
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentesubt-1);
            $pdf->Cell($cellX,$cellY,'COMPROBANTE DE PAGO',10,10,'C');

            //Datos del Tiket
            $coluY=$coluY+6;//27
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            $pdf->Cell($cellX,$cellY,$fecha_act,10,10,'C');
            $coluY=$coluY+3;//30
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'U',$fuentetex);
            $pdf->Cell($cellX,$cellY,"",10,10,'R');
            
            //Datos del H.Ayuntamiento      
            $coluY=$coluY+7;//38
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            $pdf->Multicell($cellX,3,'H. AYUNTAMIENTO DE MORELIA,',0,'C');
            
            $coluY=$coluY+1;//41
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->Cell($cellX,$cellY,utf8_decode('MICHOACÁN.'),10,0,'C');

            $pdf->SetFont($tipfuente,'',$fuentetex);
            $coluY=$coluY+7;//46
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->MultiCell($cellX,3,utf8_decode('TESORERÍA MUNICIPAL, MUNICIPIO DE'),0,'C');
            
            $coluY=$coluY+1;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->Cell($cellX,$cellY,'MORELIA.',10,0,'C');
            
            //RFC
            $coluY=$coluY+4;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->Cell($cellX,$cellY,'R.F.C. MMM-850101-843.',10,0,'C');
            //DOMICILIO FISCAL
            $pdf->SetFont($tipfuente,'',$fuentetex);
            $coluY=$coluY+7;//46
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->MultiCell($cellX,3,utf8_decode('Allende No. 403, Col. Centro, C.P 58000'),0,'C');

            $coluY=$coluY+4;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX+3);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'CUENTA PREDIAL: ',10,0,'J');

            $coluY=$coluY;//52
            $pdf->SetY($coluY);
            $pdf->SetX($posiX+11);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            $pdf->Cell($cellX,$cellY,$cuentaPredial,0,0,'C');

            $coluY=$coluY+4;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX+3);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'PROPIETARIO: ',10,0,'C');

            $coluY=$coluY+6;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            // $pdf->Cell($cellX,$cellY,$propietario,0,0,'C');
            $pdf->MultiCell($cellX,3,utf8_decode($propietario),0,'C');

            $coluY=$coluY+4;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX+3);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'UBICACION: ',10,0,'C');

            $coluY=$coluY+6;//52
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            // $pdf->Cell($cellX,$cellY,$ubicacion,0,0,'C');
            $pdf->MultiCell($cellX,3,utf8_decode($ubicacion),0,'C');
        
            //Datos del Trmaitante y Cajero     
            $coluY=$coluY+6;//57
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'OBSERVACIONES:',10,0,'C');
         
            $coluY=$coluY+5;//57
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            $pdf->MultiCell(65,4,utf8_decode($observaciones),0,'C');

            $coluY=$pdf->GetY();//61

            $coluY=$coluY;//30
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex+1);
            $pdf->Cell($cellX,$cellY,utf8_decode("TRANSACCIÓN - ").$tran,10,10,'C');

            $coluY=$coluY+5;
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'CAJERO:',10,0,'L');

            $pdf->SetX($lineX1-10);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            $pdf->Cell($cellX,$cellY,$cajerocobro,10,0,'L');

            $coluY=$coluY+4;//61
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'OFICINA RECAUDADORA:',10,0,'L');


            $coluY=$coluY+4;//61
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            $pdf->Cell($cellX,$cellY,$oficinaRecauda,10,0,'L');

            //Datos del Cobro
            $coluY=$coluY+7;//80
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'CONCEPTO',10,0,'L');

            $pdf->SetX($lineX1+8);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'FOLIO',10,0,'L');

            $pdf->SetX($lineX3);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'IMPORTE',10,0,'L');


            //Lineas 
            // $liney=$coluY;
            // $coluY=$coluY;//88
            // $pdf->SetX(0);
            // $pdf->SetY($coluY);
            // $pdf->SetX($posiX);
            // $pdf->Image('img\linea.jpg',2,$liney-6,-550);

            $coluY=$coluY;//88
            $pdf->SetX(0);
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->Image('img\linea.jpg',2,$liney,-550);

            $coluY=$coluY+7;
                $liney2=$coluY;

            $pdf->SetX(0);
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->Image('img\linea.jpg',2,$liney2,-550);

            //////////////////////////////////////////////////////
            ///LINEAS DE PREDIAL
            if ($importepredial != '0.0') {
                // $coluY=$coluY+7;
                // $liney=$coluY;
                $pdf->SetY($coluY);
                $pdf->SetX($posiX);
                $pdf->SetFont($tipfuente,'I',$fuentetex);
                $pdf->Cell($cellX,$cellY,'Impuesto Predial',10,0,'L');
                //FOLIO
                if ($recibopredial == 0 ) {
                    $recibopredial='';
                }
                else{
                    $pdf->SetX($lineX3-20);
                    $pdf->SetFont($tipfuente,'B',$fuentetex);
                    $pdf->Cell($cellX,$cellY,$recibopredial,10,0,'L');
                }
                //IMPORTE
                $pdf->SetX($lineX3-4);
                $pdf->SetFont($tipfuente,'B',$fuentetex);
                $pdf->Cell($cellX,$cellY,'$ '.$importepredial,10,0,'L');
                //Mensaje Predial
                // $coluY=$coluY+6;
                // $liney=$coluY;
                // $conceptopredial = '';
                if ($conceptopredial != '') {
                    $pdf->SetY($coluY+5);
                    $pdf->SetX($posiX);
                    $pdf->SetFont($tipfuente,'I',$fuentetex);
                    $pdf->Cell($cellX,$cellY,utf8_decode($conceptopredial),10,0,'L');
                    $coluY=$coluY+3;
                }
                // $coluY=$coluY-3;
            }
            // LOTES BALDIOS
            if ($adeudobaldios != '0.0') {
                if ($importepredial != '0.0') {
                    $coluY=$coluY+7;
                }
                else{
                    $coluY=$coluY+1;
                }
                // $liney=$coluY;
                $pdf->SetY($coluY);
                $pdf->SetX($posiX);
                $pdf->SetFont($tipfuente,'I',$fuentetex);
                $pdf->Cell($cellX,$cellY,'Impuesto Lotes',10,0,'L');
                //importe
                $pdf->SetX($lineX3-4);
                $pdf->SetFont($tipfuente,'B',$fuentetex);
                $pdf->Cell($cellX,$cellY,'$ '.$adeudobaldios,10,0,'L');
                //folio
                if ($recibobaldios == 0 ) {
                    $recibobaldios='';
                }
                else{
                $pdf->SetX($lineX3-20);
                $pdf->SetFont($tipfuente,'B',$fuentetex);
                $pdf->Cell($cellX,$cellY,$recibobaldios,10,0,'L');
                }
                //segundo renglon
                $pdf->SetY($coluY+4);
                $pdf->SetX($posiX);
                $pdf->SetFont($tipfuente,'I',$fuentetex);
                $pdf->Cell($cellX,$cellY,utf8_decode('Baldíos'),10,0,'L');
                //mensaje
                if ($conceptobaldios != '') {
                    $pdf->SetY($coluY+8);
                    $pdf->SetX($posiX);
                    $pdf->SetFont($tipfuente,'I',$fuentetex);
                    $pdf->Cell($cellX,$cellY,utf8_decode($conceptobaldios),10,0,'L');
                    $coluY=$coluY+4;
                }
            }
            //Alumbrado Publico
            if ($adeudodap != '0.0') {
                if ($adeudobaldios == '0.0' && $importepredial == '0.0') {
                    $coluY=$coluY+1;
                }
                else if ($adeudobaldios != '0.0') {
                    $coluY=$coluY+10;
                }
                else{
                    $coluY=$coluY+7;
                }
                
                // $liney=$coluY;
                $pdf->SetY($coluY);
                $pdf->SetX($posiX);
                $pdf->SetFont($tipfuente,'I',$fuentetex);
                $pdf->Cell($cellX,$cellY,utf8_decode('Alumbrado Público'),10,0,'L');
                //importe
                $pdf->SetX($lineX3-4);
                $pdf->SetFont($tipfuente,'B',$fuentetex);
                $pdf->Cell($cellX,$cellY,'$ '.$adeudodap,10,0,'L');
                //folio
                if ($recibodap == 0 ) {
                    $recibodap='';
                }
                $pdf->SetX($lineX3-20);
                $pdf->SetFont($tipfuente,'B',$fuentetex);
                $pdf->Cell($cellX,$cellY,$recibodap,10,0,'L');
                //mensaje
                if ($conceptodap != '') {
                    $pdf->SetY($coluY+5);
                    $pdf->SetX($posiX);
                    $pdf->SetFont($tipfuente,'I',$fuentetex);
                    $pdf->Cell($cellX,$cellY,utf8_decode($conceptodap),10,0,'L');
                    $coluY=$coluY+3;
                }
            }
            
            if ($adeudoisai != '0.0') {
                if ($adeudobaldios == '0.0' && $importepredial == '0.0' && $adeudodap== 0.0) {
                    $coluY=$coluY+1;
                }
                else if ($adeudodap != '0.0') {
                    $coluY=$coluY+7;
                }
                else{
                    $coluY=$coluY+9;
                }
                // $liney=$coluY;
                $pdf->SetY($coluY);
                $pdf->SetX($posiX);
                $pdf->SetFont($tipfuente,'I',$fuentetex);
                $pdf->Cell($cellX,$cellY,utf8_decode('ISAI'),10,0,'L');
                //importe
                $pdf->SetX($lineX3-4);
                $pdf->SetFont($tipfuente,'B',$fuentetex);
                $pdf->Cell($cellX,$cellY,'$ '.$adeudoisai,10,0,'L');
                //folio
                if ($reciboisai == 0 ) {
                    $reciboisai='';
                }
                $pdf->SetX($lineX3-20);
                $pdf->SetFont($tipfuente,'B',$fuentetex);
                $pdf->Cell($cellX,$cellY,$reciboisai,10,0,'L');
                //mensaje
                if ($conceptoisai != '') {
                    $pdf->SetY($coluY+4);
                    $pdf->SetX($posiX);
                    $pdf->SetFont($tipfuente,'I',$fuentetex);
                    $pdf->Cell($cellX,$cellY,utf8_decode($conceptoisai),10,0,'L');
                    $coluY=$coluY+3;
                }
            }

            // $liney=$coluY;
            // $coluY=$coluY+1;//88
            // $pdf->SetX(0);
            // $pdf->SetY($coluY);
            // $pdf->SetX($posiX);
            // $pdf->Image('img\linea.jpg',2,$liney-6,-550);

            // $coluY=$coluY+1;//88
            // $pdf->SetX(0);
            // $pdf->SetY($coluY);
            // $pdf->SetX($posiX);
            // $pdf->Image('img\linea.jpg',2,$liney,-550);

            $coluY=$coluY+10;
                $liney2=$coluY;

            $pdf->SetX(0);
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->Image('img\linea.jpg',2,$liney2,-550);

            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetX($lineX1);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'TOTAL',10,0,'L');

            $pdf->SetX($lineX3-6);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,"$ ".$montocobrado,0,0,'L');//cantidadletra

            //Letra
            $coluY=$coluY+6;//100
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            // $pdf->Cell($cellX,$cellY,$cantidadletra,10,0,'L');
            $pdf->MultiCell($cellX,3,utf8_decode($cantidadletra),0,'C');
            
            //Detalles de la Transaccion
            $coluY=$coluY+8;//100
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'T. DE PAGO:',10,0,'L');

            $pdf->SetX($lineX1-5);
            $pdf->SetFont($tipfuente,'I',$fuentetex);
            $pdf->Cell($cellX,$cellY,$tipoPag,10,0,'L');
            if($tpago=="E"){
                $coluY=$coluY+4;//61
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'RECIBIDO:',10,0,'L');

            $pdf->SetX($lineX1-8);
            $pdf->SetFont($tipfuente,'I',$fuentetex);
            $pdf->Cell($cellX,$cellY,'$'.$recibido,10,0,'L');

            $coluY=$coluY+4;//65
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'CAMBIO:',10,0,'L');

            $pdf->SetX($lineX1-10);
            $pdf->SetFont($tipfuente,'I',$fuentetex);
            $pdf->Cell($cellX,$cellY,'$'.$cambio,10,0,'L');

            $coluY=$coluY+4;//65
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'REFERENCIA:',10,0,'L');

            $pdf->SetX($lineX1-3);
            $pdf->SetFont($tipfuente,'I',$fuentetex);
            $pdf->Cell($cellX,$cellY,$numerodetransaccion,10,0,'L');

            }
            else if($tpago=="T"){
                    $coluY=$coluY+4;//61
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'NO. OPERACI'.utf8_decode('Ó').'N: ',10,0,'L');

            $pdf->SetX($lineX1+7);
            $pdf->SetFont($tipfuente,'I',$fuentetex);
            $pdf->Cell($cellX,$cellY,$noperacion,10,0,'L');

            $coluY=$coluY+4;//65
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'NO. AUTORIZACI'.utf8_decode('Ó').'N:',10,0,'L');

            $pdf->SetX($lineX1+12);
            $pdf->SetFont($tipfuente,'I',$fuentetex);
            $pdf->Cell($cellX,$cellY,$nautorizacion,10,0,'L');
            }
        
            $coluY=$coluY+10;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'IMPORTANTE:',10,0,'C');
            $coluY=$coluY+7;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'',$fuentetex+1);
            $pdf->MultiCell(68,4,utf8_decode($notainformativa),0,'C');
            $pdf->Cell($cellX,$cellY,"",10,0,'J');
            // SU NUEVA CUENTA PREDIAL ES:1-101-1-1207

            $coluY=$coluY+5;
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetit);

            $pdf->SetFont($tipfuente,'',10);
            $coluY=$coluY+5;
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->Code128(10,$coluY,$notransaccion,50,15);

            // $pdf->SetY($coluY);
            // $pdf->SetX($posiX);
            // $pdf->SetFont($tipfuente,'B',$fuentetex);
            // $pdf->Cell($cellX,38,$notransaccion,10,0,'C');  
            

            $pdf->Output();
            $this->logSW("genero ticket de pago OK");
            }
            else {
                $this->logSW("Error Al registrar pago status diferente de 1");
                //$this->TicketPago($Resultado);
                exit;
            }
    }

    public function ErrorServer(){
        $this->logSW("metodo ErrorServer- Error en Servidor");
        $data['vista'] = $this->load->view('frmErrorServicio.php', '', TRUE); //True para pasar la vista como dato
        $this->load->view('templates/layout', $data);
    }

    function logSW($cadena){
        try {
            $direcion = APPPATH."/logs/PREDIAL/";
            $control = fopen($direcion."LogsServicios-".date('d-m-Y').".log","a+");
            if($control == true){
                fwrite($control,date('d/m/Y h:i:s ')."  ".$cadena. PHP_EOL);
                fclose($control);
            }
        } catch (Exception $e) {}        
    }
}
