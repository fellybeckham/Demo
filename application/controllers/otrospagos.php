<?php
// error_reporting(0);
require_once APPPATH."/third_party/fpdf/code128.php";
class Otrospagos extends CI_Controller{

    private $data;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('opagos_model');
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation'));
        // $this->data['breadcrumb'] = 'breadcrumb_curp.jpg';
    }
    
    public function index() {
        //obtener Session
        $this->logSW("Inicio de Servicio Obtine Session");
        $data['session']= $this->opagos_model->inicioSession();
        //Obtiene Ingresos
        $this->logSW("Inicio de Servicio Obtine Ingresos");
        $data['IngresosOtrospagos'] = $this->opagos_model->GetIngresos($data['session']);
        // $this->logSW("Get ingresos: ".var_export($data['IngresosOtrospagos'], true));
        $data['Valor2'] = "";
        $data['Valor3'] = "";
        $data['tipoingreso'] = 0;
        $data['MensajeError'] = "";
        $data['MensajeAudio'] = "";
        //Valida Si hay Session 
        $this->logSW("Valida Si hay Session");
        if ($data['session']=='No hay Session') {
            $this->logSW("Error No hay Session");
            $datas['Error'] = "NoSession";
            $data['vista'] = $this->load->view('frmErrorServicio.php', $datas, TRUE); //True para pasar la vista como dato
            $this->load->view('templates/layout', $data);
        }
        else{
            $data['vista'] = $this->load->view('opagos/index.php',$data, TRUE); //True para pasar la vista como dato
            $this->load->view('templates/layout', $data);
        }
    }

    public function buscarOPagos(){
        $data['IngresosOtrospagos'] = $this->opagos_model->GetIngresos($this->input->post('sesion'));
        //validaciones
        $this->form_validation->set_rules('tipoingreso', 'tipoingreso', 'callback_tipoingreso_check');
        $this->form_validation->set_rules('ingreso2', 'ingreso2', 'required');
        $this->form_validation->set_rules('ingreso3', 'ingreso3', 'required');
        //Mensajes
        // %s es el nombre del campo que ha fallado
        $this->form_validation->set_message('required','Este dato es obligatorio');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        //Valida Formulario
        if ($this->form_validation->run() === true) {
            //datos completos de Formulario
            $session = $this->input->post('sesion');
            $tipoingreso = $this->input->post('tipoingreso');
            $Valor2 = $this->input->post('ingreso2');
            $Valor3 = $this->input->post('ingreso3');

            //Consulto WS 
            $Resultado = $this->opagos_model->opagos_busqueda($tipoingreso, $Valor2, $Valor3, $session);
            $this->logSW("Datos de Busqueda: ".var_export($session." ".$tipoingreso." ".$Valor2." ".$Valor3 , true));
            if ($Resultado=="No hay parametros") {
                $data['session'] = $session;
                $data['tipoingreso'] = $tipoingreso;
                $data['Valor2'] = $Valor2;
                $data['Valor3'] = $Valor3;

                $data['MensajeError'] = "No se encontró Adeudo con los parámetros proporcionados";
                $data['MensajeAudio'] = "<script type='text/javascript'>window.external.reproducirAudio('5')</script>";
                $this->logSW("No encontro Resultado: ");
                $data['vista'] = $this->load->view('opagos/index.php', $data, TRUE); //True para pasar la vista como dato
                $this->load->view('templates/layout', $data);
            }
            else{
                $this->logSW("Si se encontro Los datos de busqueda: ".var_export($Resultado , true));
                $data['tipoingreso'] = $tipoingreso;
                $data['Valor2'] = $Valor2;
                $data['Valor3'] = $Valor3;
                $data['Enviados'] = $session;
                $data['DatosBusqueda'] = $Resultado;
                $data['Apellido'] = $this->input->post('ingreso3');
                $data['vista'] = $this->load->view('opagos/Buscado.php',$data, TRUE); //True para pasar la vista como dato
                $this->load->view('templates/layout', $data);
            }
        }
        else{
            //datos Incorrectos de formulario
            $data['session'] = $this->input->post('sesion');
            $data['tipoingreso'] = $this->input->post('tipoingreso');
            $data['Valor2'] = $this->input->post('ingreso2');
            $data['Valor3'] = $this->input->post('ingreso3');
            $data['MensajeError'] = "";
            $data['MensajeAudio'] = "";
            if (!empty($data['session'])) {
                $this->logSW("Datos Incorrectos de busqueda no paso validacion");
                $data['vista'] = $this->load->view('opagos/index.php', $data, TRUE); //True para pasar la vista como dato
                $this->load->view('templates/layout', $data);    
            }
            else {
                $datas['Error'] = "NoSession";
                $data['vista'] = $this->load->view('frmErrorServicio.php', $datas, TRUE); //True para pasar la vista como dato
                $this->load->view('templates/layout', $data);       
            }
            
        }

    }
    
    public function tipoingreso_check($str)
    {
        if ($str == '0')
        {
            $this->form_validation->set_message('tipoingreso_check', 'Seleccione el Tipo de Pago');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function vendingcobrar(){           
        array_walk($_GET , array($this, 'filtro'));
        $this->load->view('opagos/vending', true);             
    } 

    public function filtro(&$value){
        $value = trim(utf8_encode($value));
    } 


    public function pago(){       
        //datos para pago
        $data['session'] = $this->input->post('sesion');
        $data['tipoingreso'] = $this->input->post('tipoingreso');
        $data['Valor2'] = $this->input->post('ingreso2');
        $data['Valor3'] = $this->input->post('ingreso3');
        $data['montoadeudo'] = $this->input->post('montoadeudo');
        $this->logSW("Paso pantalla de  pago, Pagara".var_export($this->input->post('montoadeudo'), true));
        $this->data['vista'] = $this->load->view('opagos/pago', $data, TRUE);
        $this->load->view('templates/layout', $this->data);        
    } 

    public function ErrorServer(){
        $this->logSW("metodo ErrorServer- Error en Servidor");
        $data['vista'] = $this->load->view('frmErrorServicio.php', '', TRUE); //True para pasar la vista como dato
        $this->load->view('templates/layout', $data);
    }

    public function RegistraPago(){
        //Datos de Pago
        $tipoadeudo = $this->input->get('tipoadeudo');
        $folio = $this->input->get('folio');
        $sesion = $this->input->get('SESION');
        $montoadeudo = $this->input->get('montoadeudo');

        //echo "Datos Recibidos ".$tipoadeudo." ".$folio." ".$sesion." ".$montoadeudo;

        $Resultado = $this->opagos_model->RegistraPago($tipoadeudo,$folio,$sesion,$montoadeudo);
        if ($Resultado['0']=="'estatus':1") {
                //Variables de ticket
                $folioTicket = str_replace(["folio':'" ,"'"], "", $Resultado['3']);
                $oficinaRecauda = str_replace(["oficinadecobro':'" ,"'"], "", $Resultado['4']);
                $propietario = str_replace(["propietario':'" ,"'"], "", $Resultado['6']);
                $ubicacion = str_replace(["ubicacion':'" ,"'"], "", $Resultado['7']);
                //conceptos y folios
                $concepto = str_replace(["concepto':'" ,"'"], "", $Resultado['12']);
                $recibo = str_replace(["recibo':" ,"'"], "", $Resultado['13']);
                $importe = str_replace(["montocobrado':'" ,"'"], "", $Resultado['14']);
                $losConceptos = str_replace(["losconceptos':'" ,"'"," | "], ["","" ,"\n"], $Resultado['15']);
                $cantidadletra = str_replace(["cantidadletra':'" ,"'"], "", $Resultado['16']);
                $cajerocobro = str_replace(["cajerocobro':'" ,"'"], "", $Resultado['18']);
                $observaciones = str_replace(["observaciones':'" ,"'"], "", $Resultado['9']);
                $notainformativa = str_replace(["notainformativa':'" ,"'"], "", $Resultado['10']);
                $cadenaverificacion = str_replace(["cadenaverificacion':'" ,"'"], "", $Resultado['11']);
                $notransaccion = str_replace(["notransaccion':" ,"'"], "", $Resultado['19']);
                $referencia = str_replace(["numerodetransaccion':" ,"'"], "", $Resultado['2']);

                $numTran = empty( $_GET['idTransaccion'] )  ? '' : $_GET['idTransaccion'];
                $recibido = empty( $_GET['recibido'] )  ? '0' : $_GET['recibido'];
                $cambio = empty( $_GET['cambio'] )  ? '0' : $_GET['cambio'];
                $idKiosco = empty( $_GET['idKiosco'] )  ? '--' : $_GET['idKiosco'];
                $ccName = empty( $_GET['ccName'] )  ? '--' : $_GET['ccName'];
                $ccNum = empty( $_GET['ccNum'] )  ? '--' : $_GET['ccNum'];
                $NoOperacion = empty( $_GET['NoOperacion'] )  ? '--' : $_GET['NoOperacion'];
                $NoAutorizacion = empty( $_GET['NoAutorizacion'] )  ? '--' : $_GET['NoAutorizacion'];

                // Agregado Campos a DB paar Cancelacion
                $this->logSW("Guarda Datos de Pago: referencia-".var_export($referencia,ture).' Session-'.var_export($sesion,true).' IdTransaccion-'.var_export($numTran,true));
                $CancelacionDB = $this->opagos_model->AddCancelacionDB($referencia,$sesion,$numTran);
                
                $cambio = str_replace("?","",$cambio);
                $recibido = str_replace("?","",$recibido);
                $idTransaccion = str_replace("?","",$numTran);
                $ubicacion = str_replace("?","",$ubicacion); 
                $tran=$_GET["idTransaccion"];

                $pdf=new PDF_Code128('P','mm',array(350,210));
            
            // for ($z=0; $z <= 1; $z++) { 
                $pdf->AddPage();
                $this->logSW("entra a generar ticket.");
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
                // $observaciones=strtoupper ($observaciones);
                // $observaciones = str_replace("DICTAMEN", "Hola", $observaciones);
                $oficinaRecauda=strtoupper ($oficinaRecauda);
                $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
                $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"); 
                
                $fecha_act=  $week_days[date ("w")].' '. date ( 'd' ).' de '.$months[ date ("n")].' de '.date('Y').' '.date('h').':'.date('i').' Hrs' ;
                // $ticket2="tiket2.pdf";
                
                
                
                
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
                $pdf->Cell($cellX,$cellY,$folioTicket,10,0,'C');

                $coluY=$coluY+6;//49
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

                $coluY= $pdf->GetY();
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
                $coluY= $pdf->GetY();
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
                $liney=$coluY;
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
                ///LINEAS DE Concepto Folio Importe
                
                    // $coluY=$coluY+7;
                    // $liney=$coluY;
                    $pdf->SetY($coluY);
                    $pdf->SetX($posiX);
                    $pdf->SetFont($tipfuente,'I',$fuentetex-1);
                    $pdf->Cell($cellX,$cellY,$concepto,10,0,'L');
                    //FOLIO
                    // if ($recibopredial == 0 ) {
                    //     $recibopredial='';
                    // }
                    // else{
                        $pdf->SetX($lineX3-20);
                        $pdf->SetFont($tipfuente,'B',$fuentetex);
                        $pdf->Cell($cellX,$cellY,$recibo,10,0,'L');
                    // }
                    //IMPORTE
                    $pdf->SetX($lineX3-4);
                    $pdf->SetFont($tipfuente,'B',$fuentetex);
                    $pdf->Cell($cellX,$cellY,'$ '.$importe,10,0,'L');
                    //Mensaje Predial
                    // $coluY=$coluY+6;
                    // $liney=$coluY;
                    // $conceptopredial = '';
                    
                        $pdf->SetY($coluY+7);
                        $pdf->SetX($posiX);
                        // $pdf->SetFont($tipfuente,'I',$fuentetex);
                        // $pdf->Cell($cellX,$cellY,utf8_decode($losConceptos),10,0,'L');
                        $pdf->SetFont($tipfuente,'',$fuentetex-1);
                        $pdf->MultiCell(65,3,utf8_decode($losConceptos),0,'J');
                        // $coluY=$coluY+3;
                    
                    // $coluY=$coluY-3;
                
                

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

                $coluY= $pdf->GetY();
                // $pdf->SetY($coluY);
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
                $pdf->Cell($cellX,$cellY,"$ ".$importe,0,0,'L');//cantidadletra

                //Letra
                $coluY=$coluY+6;//100
                $pdf->SetY($coluY);
                $pdf->SetX($posiX);
                $pdf->SetFont($tipfuente,'',$fuentetex);
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
                $pdf->Cell($cellX,$cellY,$referencia,10,0,'L');

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
                
                //CadenaVerificacion
                $coluY=$coluY+10;//49
                $pdf->SetY($coluY);
                $pdf->SetX($posiX);
                $pdf->SetFont($tipfuente,'B',$fuentetex);
                $pdf->Cell($cellX,$cellY,'CADENA DE VERIFICACION:',10,0,'C');
                $coluY= $pdf->GetY();
                $pdf->SetY($coluY);
                $pdf->SetX($posiX);
                $pdf->SetFont($tipfuente,'',$fuentetex+1);
                $pdf->MultiCell(68,4,utf8_decode($cadenaverificacion),0,'C');
                $pdf->Cell($cellX,$cellY,"",10,0,'J');

                //Nota
                $coluY=$coluY+7;//49
                $pdf->SetY($coluY);
                $pdf->SetX($posiX);
                $pdf->SetFont($tipfuente,'B',$fuentetex);
                $pdf->Cell($cellX,$cellY,'IMPORTANTE:',10,0,'C');
                $coluY= $pdf->GetY();
                $pdf->SetY($coluY);
                $pdf->SetX($posiX);
                $pdf->SetFont($tipfuente,'',$fuentetex+1);
                $pdf->MultiCell(68,4,utf8_decode($notainformativa),0,'C');
                $pdf->Cell($cellX,$cellY,"",10,0,'J');
                // SU NUEVA CUENTA PREDIAL ES:1-101-1-1207

                $coluY= $pdf->GetY();
                $pdf->SetY($coluY);
                $pdf->SetX($posiX);
                $pdf->SetFont($tipfuente,'B',$fuentetit);

                $pdf->SetFont($tipfuente,'',10);
                $coluY=$coluY+5;
                $pdf->SetY($coluY);
                $pdf->SetX($posiX);
                $pdf->Code128(10,$coluY,$notransaccion,50,15);


                // $coluY=$coluY+10;//49
                // $pdf->SetY($coluY);
                // $pdf->SetX($posiX);
                // $pdf->SetFont($tipfuente,'',$fuentetex);
                // $pdf->Cell($cellX,$cellY,'',10,0,'C');

                // $pdf->SetY($coluY);
                // $pdf->SetX($posiX);
                // $pdf->SetFont($tipfuente,'B',$fuentetex);
                // $pdf->Cell($cellX,38,$notransaccion,10,0,'C');  
                $pdf->Output();
                $this->logSW("genero ticket de pago OK");
            // }
        
        }
        else{
             $this->logSW("Error Al registrar pago status diferente de 1");
                // echo $Resultado;
                //$this->TicketPago($Resultado);
                exit;
        }
        // echo "<br>Resultado ";
        // echo "<pre>";
        // print_r($Resultado);
        // echo "</pre>";
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
}
