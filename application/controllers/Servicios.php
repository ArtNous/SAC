<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {

	private $bds = array();
	private $data = array();
    
    private $bc_inicial = "Servicios";
    private $bc_crear = "Crear";
    private $crearUrl = "servicios/crear";
    private $urlEliminar = "servicios/eliminar";
    private $urlEditar = "servicios/editar/";
    private $servicioCod = null;
    private $urlVer = "servicios/ver/";

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
	public function index()
	{
	
		$this->load->helper('form');
		$this->load->library('form_validation');
        
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('servicios'),'nombre'=>$this->bc_inicial),);
		$this->data['urlCrear'] = $this->crearUrl;
		$this->data['titulo'] = 'Lista de Servicios';
		$this->data['nombre_ix'] = 'servicios';
		$this->data['tooltip'] = 'servicio';
		$this->data['bds'] = $this->bds;

		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('componentes/lista_webix',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);
	}

	public function crear($codigo = null){
		
		$this->data['bds'] = $this->bds;
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('servicios'),'nombre'=>$this->bc_inicial),
			array('url'=>base_url('servicios/crear'),'nombre'=>$this->bc_crear),);

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('codigo', 'codigo del servicio', 'required',array('required' => 'El campo debe ser llenado'));
		$this->form_validation->set_rules('nombre', 'nombre del servicio', 'required',array('required' => 'El campo debe ser llenado'));
		$this->form_validation->set_rules('descripcion', 'descripcion del servicio', 'required',array('required' => 'El campo debe ser llenado'));
		$this->form_validation->set_error_delimiters('<div class="error_form_orden">','</div>');

		if($codigo != null){
			$this->data['servicio'] = $this->servicio->ver($codigo);
		}

	    if ($this->form_validation->run() == FALSE)
		{
			$datos['servicios'] = $this->servicio->listar();
			$this->load->view('apertura');
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('servicios/crear',$this->data);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else	    
        {
            $servicio = array(
              'codigo' => $this->input->post('codigo'),
              'nombre' => $this->input->post('nombre'),
              'descripcion' => $this->input->post('descripcion'),
              'prox_km' => $this->input->post('km')
            );
            if($codigo != null){
            	$this->servicio->actualizar($servicio);
	            redirect('servicios');
            }
	        $this->servicio->crear($servicio);
	    }
	}

	public function eliminar($codigo){
		$this->servicio->eliminar($codigo);
        redirect('servicios');
	}
    
    public function ver($id){
    	
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('servicios/'),'nombre'=>$this->bc_inicial),
			array('url'=>base_url('#'),'nombre'=>'Ficha'),);

		$this->data['servicio'] = $this->servicio->ver($id);
		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('servicios/ficha',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);
	}

	public function verificarCodigo($codigo){
		$servicio = $this->servicio->ver($codigo);
		if( $codigo == $servicio['codigo'] ){
			$res = 1;
		} else {
			$res = 2;
		}
		echo $res;
	}
}
