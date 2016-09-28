<?php

class Error extends CI_Controller{

    private $data;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('predial_model');
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session'));
        // $this->data['breadcrumb'] = 'breadcrumb_curp.jpg';
    }
    
    public function index() {
        $data['vista'] = $this->load->view('frmErrorServicio.php', '', TRUE); //True para pasar la vista como dato
        $this->load->view('templates/layout', $data);
    }

}
