<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	private $bds = array();
    
    private $bc_inicial = "Reportes";

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->db->db_select($this->session->userdata('bd'));
		$this->load->model('servicio');

        if(!$this->session->userdata('usuario')){
            redirect('auth/login');
        }       
        $this->bds = $this->session->userdata('bds');
	}
	// Muestra vista con lista de marcas disponibles
	public function index()
	{
      	$this->data['css'] = array(
			"assets/css/materialize.min.css",
			"assets/css/estilos.css",
			// "assets/css/dragula.min.css",
			"assets/css/configuracion/estilo.css",
			// "assets/webix/webix.css",
			"assets/webix/skins/air.css",
			// "assets/css/sweetalert2.min.css",
			"assets/css/form_cliente.css",
		);
        $this->load->helper('form');
		$this->load->library('form_validation');
        
		$data['niveles'] = array(
			array('url'=>base_url('orden'),'nombre'=>'Principal'),
			array('url'=>'#','nombre'=>'Reportes'),);

        $data['servicios'] = $this->servicio->listar();

		$this->load->view('apertura',$this->data);
		$this->load->view('header/principal');
		$this->load->view('main/principal',$data);
        $this->load->view('reportes/principal',$data);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$data);
	}

}
