<?php
/*error_reporting(0);*/
require_once APPPATH."/third_party/fpdf/code128.php";
class activarMonedero extends CI_Controller{

    private $data;

        public function __construct() {
        parent::__construct();
       $this->load->model('activarMonedero_model');
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session'));
        // $this->data['breadcrumb'] = 'breadcrumb_curp.jpg';
    }

public function index() {
      $data['vista'] = $this->load->view('activarMonedero/index.php',$data, TRUE); //True para pasar la vista como dato
            $this->load->view('templates/layout', $data);
        }
    }
?>