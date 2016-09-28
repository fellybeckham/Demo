<?php

class Servicios extends CI_Controller{

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation'));
    }
    
    public function index() {
        $data['vista'] = $this->load->view('index', '', TRUE); //True para pasar la vista como dato
        $this->load->view('templates/layout', $data);
    }

    public function copias(){
        $this->data['vista'] = $this->load->view('share/copias', '', TRUE); //True para pasar la vista como dato
        $this->load->view('templates/layout', $this->data);
    }


    public function pago(){
        $this->data['vista'] = $this->load->view('share/pago', '', TRUE); //True para pasar la vista como dato
        $this->load->view('templates/layout', $this->data);
    }

    public function Trabajando(){
        $this->data['vista'] = $this->load->view('share/trabajando', '', TRUE); //True para pasar la vista como dato
        $this->load->view('templates/layout', $this->data);
    }

}

?>