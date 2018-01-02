<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipos_vehiculos extends CI_Controller {

	private $bds = array();
	private $data = array();

	private $urlCrear = "tipos_vehiculos/crear";
    private $urlEliminar = "tipos_vehiculos/eliminar";
    private $urlEditar = "tipos_vehiculos/editar/";
    private $urlVer = "tipos_vehiculos/ver/";

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->db->db_select($this->session->userdata('bd'));
		$this->load->model('tipo_vehiculo');
		if(!($this->session->userdata('usuario') && ($this->session->userdata('rol') == 1))){
            redirect('acciones/noadmin');
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
		$this->data['bds'] = $this->bds;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
			array('url'=>base_url('tipos_vehiculos'),'nombre'=>'Tipos de vehículos'));

        $this->data['urlCrear'] = $this->urlCrear;
        $this->data['titulo'] = 'Lista de Tipos de Vehículos';
        $this->data['nombre_ix'] = 'tipos';
        $this->data['tooltip'] = 'tipo de vehículo';

		$this->load->view('apertura',$this->data
	);
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('componentes/lista_webix',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre');
	}

	public function crear(){
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
		$this->data['bds'] = $this->bds;
		$this->data['niveles'] = array(
			array('url'=>base_url('orden'),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
			array('url'=>base_url('tipos_vehiculos/'),'nombre'=>'Tipos de vehículos'),
			array('url'=>base_url('tipos_vehiculos/crear'),'nombre'=>'Crear'),);

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('descripcion', 'tipo del vehiculo', 'required|is_unique[TipoVehiculo.descripcion]',
		array(
            'required' => 'El campo debe ser llenado.',
            'is_unique' => 'El %s ya existe.',
        ));
         $this->form_validation->set_error_delimiters('<div class="error_form">','</div>');

	    if ($this->form_validation->run() == FALSE)
		{
			$this->data['tipos'] = $this->tipo_vehiculo->listar();
 			$this->load->view('apertura',$this->data);
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('tipos_vehiculos/crear',$this->data);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else
	    {
	        // $this->news_model->set_news();
	        $nombre = $this->input->post('descripcion');
	        $this->tipo_vehiculo->crear($nombre);
	        redirect('tipos_vehiculos');
	    }
	}

	public function editar($id){
		
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
			array('url'=>base_url('tipos_vehiculos/'),'nombre'=>'Tipos de vehículos'),
			array('url'=>base_url('tipos_vehiculos/crear'),'nombre'=>'Crear'),);

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('descripcion', 'tipo del vehiculo', 'required|is_unique[TipoVehiculo.descripcion]',
		array(
            'required' => 'El campo debe ser llenado.',
            'is_unique' => 'El %s ya existe.',
        ));

		if ($this->form_validation->run() == FALSE)
		{
			$this->data['tipo'] = $this->tipo_vehiculo->ver($id);
			// redirect('modelos');
 			$this->load->view('apertura');
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('tipos_vehiculos/editar',$this->data);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else
	    {
	        // $this->news_model->set_news();
	        $nombre = $this->input->post('descripcion');
	        $this->tipo_vehiculo->actualizar($id,$nombre);
	        redirect('tipos_vehiculos');
	    }
	}

	public function eliminar($id){

		$tipoV = $this->tipo_vehiculo->ver($id);
		if(isset($tipoV['id']))
        {
            $this->tipo_vehiculo->eliminar($id);
            redirect('tipos_vehiculos');
        } else
            show_error('El tipo de vehículo que estas intentando borrar no existe.');
	}
}
