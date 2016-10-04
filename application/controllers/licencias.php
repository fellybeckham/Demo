<?php
error_reporting(0);
//require_once APPPATH."/third_party/fpdf/code128.php";
class Licencias extends CI_Controller{

    private $data;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('licencias_model');
        $this->load->helper('form');
        $this->load->library(array('form_validation','session'));
        // $this->data['breadcrumb'] = 'breadcrumb_curp.jpg';
    }
    
    public function index() {
    
        // $resp = $this->licencias_model->inicioSession();
        // $data['session']= $resp["sesion"];
        // $data['Barra']= "";
        // $data['MensajeError'] = "";
        // $data['MensajeAudio'] = "";
        // $this->logSW("Obtiene Session: ".var_export($resp["respuesta"],true)." ".var_export($resp["sesion"],true));
        // if ($resp['estatus']=='1') {
            $data['vista'] = $this->load->view('licencias/index.php',$data, TRUE); //True para pasar la vista como dato
            $this->load->view('templates/layout', $data);
        // }
        // else{
        //     $datas['Error'] = "NoSession";
        //     $data['vista'] = $this->load->view('frmErrorServicio.php', $datas, TRUE); //True para pasar la vista como dato
        //     $this->load->view('templates/layout', $data);
            
        // }
        
    }

     public function mostrarpdf() {
            
    $this->form_validation->set_rules('textboxPaternoEmpresa', 'paterno', 'required|min_length[3]');
    $this->form_validation->set_rules('textboxMaterno', 'materno', 'required');
    $this->form_validation->set_rules('textboxNombre', 'nombre', 'required');
    $this->form_validation->set_rules('textboxtelefono', 'numtelefono', 'required');
    $this->form_validation->set_rules('textboxEmail', 'email', 'required');
    $this->form_validation->set_rules('textboxcalle', 'calle', 'required');
    $this->form_validation->set_rules('textboxnum', 'numext', 'required');
    $this->form_validation->set_rules('textboxcolonia', 'colonia', 'required');
    $this->form_validation->set_rules('textboxNumEmpleos', 'numempleos', 'required');
    $this->form_validation->set_rules('textboxInvEstimada', 'Investimada', 'required');
        
    if($this->form_validation->run() === true){
        //Si la validación es correcta, cogemos los datos de la variable POST
        //y los enviamos al modelo
        $paterno = $this->input->post('textboxPaternoEmpresa');
        $materno = $this->input->post('textboxMaterno');
        $nombre = $this->input->post('textboxNombre');
        $numtelefono = $this->input->post('textboxtelefono');
        $email = $this->input->post('textboxEmail');
        $giro = $this->input->post('imput_giro');
        $establecimiento = $this->input->post('textboxNombreEstablecimiento');
        $calle = $this->input->post('textboxcalle');
        $numext = $this->input->post('textboxnum');
        $colonia = $this->input->post('textboxcolonia');
        $codpostal = $this->input->post('textboxCP');
        $calle1 = $this->input->post('textboxCalle1');
        $calle2 = $this->input->post('textboxCalle2');
        $numempleos = $this->input->post('textboxNumEmpleos');
        $Investimada = $this->input->post('textboxInvEstimada');
        $sesion = $this->licencias_model->inicioSession();
           
        //echo $sesion.' '.$paterno.' '.$materno.' '.$nombre.' '.$numtelefono.' '.$email.' '. $giro.' '.$establecimiento.' '.$calle.' '.$numext.' '.$colonia.' '.$codpostal.' '.$calle1.' '.$calle2.' '.$numempleos.' '.$Investimada;
        $this->licencias_model->imprimirSolicitudApertura($paterno, $materno, $nombre, $numtelefono, $email, $giro, $establecimiento, $calle, $numext, $colonia, $codpostal, $calle1, $calle2, $numempleos, $Investimada, $sesion);
        
        

    }
   
    //$sesion = '1';
        //$this->licencias_model->imprimirSolicitudApertura($sesion, $paterno, $materno); 
    //$this->licencias_model->imprimirSolicitudApertura($paterno, $materno, $nombre, $numtelefono, $email, $giro, $establecimiento, $calle, $numext, $colonia, $codpostal, $calle1, $calle2, $numempleos, $Investimada, $sesion);
        
    //$data['vista'] = $this->load->view('licencias/apertura.php','', TRUE); //True para pasar la vista como dato
            //$this->load->view('templates/layout', $data);
     }

     public function apertura(){
        $sesion = $this->licencias_model->inicioSession();
        //$giro = $this->licencias_model->obtenergiros($sesion);
        $data['giro']=$this->licencias_model->obtenergiros($sesion);

        $data['vista'] = $this->load->view('licencias/apertura.php',$data, TRUE); //True para pasar la vista como dato
            $this->load->view('templates/layout', $data);

     }

    public function revalidacion(){

    }

    public function RegresarDatos()
    {
        $pagina = $this->input->post('pagina');
        $session = $this->input->post('sesion2');
        $Resultado = (array) json_decode($this->input->post('Respuesta'));  
        $data['session'] = $session;                
        $data['DatosBusqueda'] = $Resultado; 
        $data['pag'] = $pagina;
        $data['vista'] = $this->load->view('agua/Buscado.php',$data, TRUE); //True para pasar la vista como dato
        $this->load->view('templates/layout', $data);

       

    }

    public function buscarAgua(){
            $pagina = $this->input->post('pagina');
            $CodBarra = $this->input->post('CodBarra');
            $session = $this->input->post('sesion');
            $NumeroContrato = $this->input->post('NumeroContrato');
            $NexTer = $this->input->post('NexTer');   
             $this->logSW("Guardar datos de busqueda: ".var_export($session,true)." ".var_export($CodBarra,true)." ".var_export($NumeroContrato,true)." ".var_export($NexTer,true));
           if($pagina != 'Datos') 
            {
                $Resultado = $this->agua_model->Aguabusqueda($CodBarra,$NumeroContrato,$NexTer,$session);
                $this->logSW("Resultado Busqueda Agua: ".var_export($Resultado,true));
                if ($Resultado["estatus"] == "1") {
                    

                    $this->logSW("metodo buscarAgua Respuesta correcta");
                    $data['session'] = $session;                
                    $data['DatosBusqueda'] = $Resultado;
                    $data['pag'] = $pagina;
                    $data['vista'] = $this->load->view('agua/Buscado.php',$data, TRUE); //True para pasar la vista como dato
                    $this->load->view('templates/layout', $data);  
                }
                else{
                     $data['session'] = $session;
                   
                    $data['MensajeError'] = $Resultado["respuesta"];
                   
                    if(strpos($Resultado["respuesta"],"UD. NO TIENE ADEUDO ACTUAL DE AGUA") !== false)
                    {
                        $data['MensajeAudio'] = "<script type='text/javascript'>window.external.reproducirAudio('5')</script>";
                    }
                    else
                    {
                        $data['MensajeAudio'] = "<script type='text/javascript'>window.external.reproducirAudio('6')</script>";
                    }
                   
                    $this->logSW("metodo buscarAgua Estatus 0: ".var_export($Resultado["respuesta"],true) );
                    if( trim($CodBarra) == false)
                    {
                         $data['vista'] = $this->load->view('agua/busquedaDatos.php', $data, TRUE);  
                    }
                    else
                    {
                        $data['vista'] = $this->load->view('agua/index.php', $data, TRUE);  
                    }
                    $this->load->view('templates/layout', $data); 
                    
                     }
            }
            else
            {
               
                $this->form_validation->set_rules('NumeroContrato', 'Número contrato', 'required|trim');
                $this->form_validation->set_rules('NexTer', 'Número exterior', 'required|trim');

                $this->form_validation->set_message('required','El campo %s es obligatorio'); 
                $this->form_validation->set_message('integer','El campo %s debe estar compuesto solo por números');

                if($this->form_validation->run() == TRUE)//Si la validación es correcta
                { 
                    $Resultado = $this->agua_model->Aguabusqueda($CodBarra,$NumeroContrato,$NexTer,$session);
                    $this->logSW("Resultado Busqueda Agua: ".var_export($Resultado,true));
                    if ($Resultado["estatus"] == "1") 
                    {

                        $this->logSW("metodo buscarAgua Respuesta correcta");
                        $data['session'] = $session;                
                        $data['DatosBusqueda'] = $Resultado;
                        $data['pag'] = $pagina;
                        $data['vista'] = $this->load->view('agua/Buscado.php',$data, TRUE); //True para pasar la vista como dato
                        $this->load->view('templates/layout', $data);
                        
                    }
                    else
                    {
                        $data['session'] = $session;
                        $data['MensajeError'] = $Resultado["respuesta"];
                         if(strpos($Resultado["respuesta"],"UD. NO TIENE ADEUDO ACTUAL DE AGUA") !== false)
                        {
                            $data['MensajeAudio'] = "<script type='text/javascript'>window.external.reproducirAudio('5')</script>";
                        }
                        else
                        {
                            $data['MensajeAudio'] = "<script type='text/javascript'>window.external.reproducirAudio('6')</script>";
                        }
                   
                        
                        $this->logSW("metodo buscarAgua Estatus 0: ".var_export($Resultado["respuesta"],true) );
                        if( trim($CodBarra) == false)
                        {
                             $data['vista'] = $this->load->view('agua/busquedaDatos.php', $data, TRUE);  
                        }
                        else
                        {
                            $data['vista'] = $this->load->view('agua/index.php', $data, TRUE);  
                        }
                        $this->load->view('templates/layout', $data);    

                    }
                    
                }else
                {
                    $data['NumeroContrato'] = $NumeroContrato;
                    $data['NexTer'] = $NexTer;
                    $data['session'] = $session;    
                    $data['vista'] = $this->load->view('agua/BusquedaDatos.php',$data, TRUE); //True para pasar la vista como dato
                    $this->load->view('templates/layout', $data);
                    $datos["mensaje"]="Validación incorrecta";

                }
                
            }
            
           
        }
        public function busquedaDatos()
        {
            $session = $this->input->post('sesion2');
            $data['session'] = $session;              
            $data['vista'] = $this->load->view('agua/busquedaDatos.php',$data, TRUE); //True para pasar la vista como dato
            $this->load->view('templates/layout', $data);
           
        }
        
    public function FormaPago()
    {
        $data['session'] = $this->input->post('sesion');      
        $data['numerocontrato'] = $this->input->post('numerocontrato');   
        $data['importetotal'] = substr($this->input->post('importetotal'), 1);
        $data['Respuesta'] = $this->input->post('busqueda');   
        $data['pag'] = $this->input->post('pagina'); 
        $this->logSW("Paso pantalla de  pago, Pagara".var_export($this->input->post('importetotal'), true));     
        $data['vista'] = $this->load->view('agua/TipoPago.php',$data, TRUE); //True para pasar la vista como dato
        $this->load->view('templates/layout', $data);
    }

    public function vendingcobrar(){ 
        array_walk($_GET , array($this, 'filtro'));
        $this->logSW("Paso pantalla método vendingcobrar");
        $this->load->view('agua/vending', true);             
    } 

    public function filtro(&$value){
        $value = trim(utf8_encode($value));
    } 

    public function RegistraPago(){
        
        $session = $this->input->get('session', TRUE);      
        $numerocontrato = $this->input->get('numerocontrato', TRUE);   
        $importetotal = $this->input->get('importetotal', TRUE);  
        $TipoPago = $this->input->get('tipo', TRUE);  

        $Resultado = $this->agua_model->RegistraCobro($importetotal,$numerocontrato,$session);
        $this->logSW("Resultado Registro pago: ".var_export($Resultado, true));
        //$Resultado = $this->agua_model->RegistraCobroprueba();
       if ($Resultado['estatus'] == '1') {

            $numerocontrato = $Resultado['numerocontrato'];
            $fechacobro = $Resultado['fechacobro'];
            $propietario = $Resultado['propietario'];
            $domicilio = $Resultado['domicilio'];
            $montocobrado = $Resultado['montocobrado'];
            $cantidadletra = $Resultado['cantidadletra'];
            $cadenaverificacion = $Resultado['cadenaverificacion'];
            $codigobarra = $Resultado['codigobarra'];
            $id_kiosko = $Resultado['id_kiosko'];
            $concepto = $Resultado['concepto'];
            

            // $this->logSW("UBICACION: ".var_export($ubicacion, true));
            //conceptos y folios
            

            $numTran = empty( $_GET['idTransaccion'] )  ? '' : $_GET['idTransaccion'];
            $recibido = empty( $_GET['recibido'] )  ? '0' : $_GET['recibido'];
            $cambio = empty( $_GET['cambio'] )  ? '0' : $_GET['cambio'];

          
            //$idKiosco = empty( $_GET['idKiosco'] )  ? '--' : $_GET['idKiosco'];
            $ccName = empty( $_GET['ccName'] )  ? '--' : $_GET['ccName'];
            $ccNum = empty( $_GET['ccNum'] )  ? '--' : $_GET['ccNum'];
            $NoOperacion = empty( $_GET['NoOperacion'] )  ? '--' : $_GET['NoOperacion'];
            $NoAutorizacion = empty( $_GET['NoAutorizacion'] )  ? '--' : $_GET['NoAutorizacion'];

            $cambio = str_replace("?","",$cambio);
            //$cajero = str_replace("?","",$cajero);
            $recibido = str_replace("?","",$recibido);
            $idTransaccion = str_replace("?","",$numTran);
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
            

            if($TipoPago == "E")
            {
                $tipoPag="EFECTIVO";
                $tpago="E";
            }
            else
            {
                $tipoPag="TARJETA";
                $tpago="T";
            }
          
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
            $pdf->Cell($cellX,$cellY,'NUM. DE CONTRATO: ',10,0,'J');

            $coluY=$coluY;//52
            $pdf->SetY($coluY);
            $pdf->SetX($posiX+12);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            $pdf->Cell($cellX,$cellY,$numerocontrato,0,0,'C');

            $coluY=$coluY+4;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX+3);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX-4,$cellY+3,'PROPIETARIO: ',10,0,'C');

            $coluY=$coluY+6;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            // $pdf->Cell($cellX,$cellY,$propietario,0,0,'C');
            $pdf->MultiCell($cellX,6,utf8_decode($propietario),0,'C');


            
        
            //Datos del Trmaitante y Cajero     
            $coluY=$coluY+6;//57
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'DOMICILIO:',10,0,'C');
         
            $coluY=$coluY+5;//57
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            $pdf->MultiCell(65,4,utf8_decode($domicilio),0,'C');

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
            $pdf->Cell($cellX,$cellY,'KIOSCO:',10,0,'L');

            $pdf->SetX($lineX1-10);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            $pdf->Cell($cellX,$cellY,utf8_decode($id_kiosko),10,0,'L');


            //Datos del Cobro
            $coluY=$coluY+7;//80
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'CONCEPTO',10,0,'L');

            $pdf->SetX($lineX3);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'IMPORTE',10,0,'L');

            $pdf->SetY($coluY+4);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'I',8);
            $pdf->Cell($cellX,$cellY,$concepto,10,0,'L');
           
            //IMPORTE
            $pdf->SetX($lineX3+2);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,$montocobrado,10,0,'L');


            $coluY=$coluY+10;
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'TOTAL:',10,0,'L');

            $pdf->SetX($lineX1-13);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            $pdf->Cell($cellX,$cellY,$montocobrado,10,0,'L');

            $coluY=$coluY+5;
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'I',$fuentetex);
            $pdf->Cell($cellX,$cellY,'('.$cantidadletra.')',10,0,'L');
 
            $coluY=$coluY+4;//61
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX,$cellY,'T. DE PAGO:',10,0,'L');

            $pdf->SetX($lineX1-4);
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

            $coluY=$coluY+4;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX+3);
            $pdf->SetFont($tipfuente,'B',$fuentetex);
            $pdf->Cell($cellX-4,$cellY+3,utf8_decode('CADENA DE VERIFICACIÓN: '),10,0,'C');

            $coluY=$coluY+6;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            // $pdf->Cell($cellX,$cellY,$propietario,0,0,'C');
            $pdf->MultiCell($cellX,6,utf8_decode($cadenaverificacion),0,'C');
        
            $coluY=$coluY+5;
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'B',$fuentetit);

            $pdf->SetFont($tipfuente,'',10);
            $coluY=$coluY+5;
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->Code128(10,$coluY,$codigobarra,50,15);


            $coluY=$coluY+14;//49
            $pdf->SetY($coluY);
            $pdf->SetX($posiX);
            $pdf->SetFont($tipfuente,'',$fuentetex);
            // $pdf->Cell($cellX,$cellY,$propietario,0,0,'C');
            $pdf->MultiCell($cellX,6,$codigobarra,0,'C');
            

            // $pdf->SetY($coluY);
            // $pdf->SetX($posiX);
            // $pdf->SetFont($tipfuente,'B',$fuentetex);
            // $pdf->Cell($cellX,38,$notransaccion,10,0,'C');  */
            

            $pdf->Output();
            $this->logSW("genero ticket de pago OK ");
            }
            else {
                $this->logSW("Error Al registrar pago: ".var_export($Resultado["respuesta"],true));
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
            $direcion = APPPATH."/logs/AGUA/";
            $control = fopen($direcion."LogsServicios-".date('d-m-Y').".log","a+");
            if($control == true){
                fwrite($control,date('d/m/Y h:i:s ')."  ".$cadena. PHP_EOL);
                fclose($control);
            }
        } catch (Exception $e) {}        
    }
}