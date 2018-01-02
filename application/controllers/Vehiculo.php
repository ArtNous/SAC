<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiculo extends CI_Controller {

	private $bds = array();
	private $data = array();
    
    private $bc_inicial = "Vehículos";
    private $bc_crear = "Crear";
    private $urlCrear = "vehiculo/crear";
    private $urlEliminar = "vehiculo/eliminar";
    private $urlEditar = "vehiculo/editar/";
    private $urlVer = "vehiculo/ver/";
    
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->db->db_select($this->session->userdata('bd'));
		$this->load->model('vehiculos');
		$this->load->model('marca');
		$this->load->model('modelo');
		$this->load->model('tipo_vehiculo');
		if(!$this->session->userdata('usuario')){
            redirect('auth/login');
        }  
        $this->bds = $this->session->userdata('bds');
	}
	// Muestra vista con lista de vehiculos
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
			array('url'=>base_url('vehiculo'),'nombre'=>$this->bc_inicial));

		$this->data['urlCrear'] = $this->urlCrear;
        $this->data['titulo'] = 'Lista de Vehículos';
        $this->data['nombre_ix'] = 'vehiculos';
        $this->data['tooltip'] = 'vehículo';

		$this->load->view('apertura',$this->data);
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
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('vehiculo/'),'nombre'=>$this->bc_inicial),
			array('url'=>base_url('vehiculo/crear'),'nombre'=>$this->bc_crear),);

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('marca', 'marca a la que pertenece', 'required',array('required' => 'El campo debe ser llenado'));
		$this->form_validation->set_rules('placa', 'placa del vehículo', 'required',array('required' => 'El campo debe ser llenado'));
		$this->form_validation->set_rules('modelo', 'modelo', 'required',array('required' => 'El campo debe ser llenado'));
		$this->form_validation->set_rules('tipov', 'tipo del vehículo', 'required',array('required' => 'El campo debe ser llenado'));
		$this->form_validation->set_error_delimiters('<div class="error_form_orden">','</div>');

	    if ($this->form_validation->run() == FALSE)
		{
			$this->data['marcas'] = $this->marca->listar();
			$this->data['modelos'] = $this->modelo->listar();
			$this->data['tiposv'] = $this->tipo_vehiculo->listar();
 			$this->load->view('apertura',$this->data);
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('vehiculos/crear',$this->data);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else
	    {
	        $carro['marca'] = $this->input->post('marca');
	        $carro['placa'] = $this->input->post('placa');
	        $carro['modelo'] = $this->input->post('modelo');
	        $carro['tipov'] = $this->input->post('tipov');
	        $this->vehiculos->crear($carro);
	        redirect('vehiculo');
	    }
	}

	public function editar($placa){
		
    	$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('vehiculo'),'nombre'=>$this->bc_inicial),
			array('url'=>'#!','nombre'=>"Editar vehículo"),);

    	$this->load->helper('form');
		$this->load->library('form_validation');

		$vehiculo = $this->vehiculos->ver($placa);
		$marcas = $this->marca->listar();
		$tiposv = $this->tipo_vehiculo->listar();
		$this->data['modelos'] = $this->modelo->verModelosDeMarca($vehiculo['marca']);
		  if ($this->form_validation->run() == FALSE)
		{
			$this->data['placa'] = $placa;
			$this->data['vehiculo'] = $vehiculo;
			$this->data['marcas'] = $marcas;
			$this->data['tiposv'] = $tiposv;
	        $this->load->view('apertura');
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('vehiculos/editar',$this->data);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else	    
        {
            $vehiculo = array(
              'placa' => $this->input->post('placa'),
              'marca' => $this->input->post('marca'),
              'modelo' => $this->input->post('modelo'),
              'tipo_vehiculo' => $this->input->post('tipov'),
              'km_actual' => $this->input->post('km_actual'),
            );
	        $this->vehiculos->actualizar($vehiculo);
            redirect('vehiculo');
	    }

    }

	public function ver($placa){
		
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('vehiculo/'),'nombre'=>$this->bc_inicial),
			array('url'=>base_url('#'),'nombre'=>'Ficha'),);

		$this->data['auto'] = $this->vehiculos->verVehiculoPlaca($placa);
		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('vehiculos/ficha',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);
	}

	public function paraCombo(){
		$placa = $this->input->post('valor');
		$placas = $this->vehiculos->dameSimilares($placa);
		foreach ($placas as $p) {
			$res[$p['placa']] = null;
		}
		echo json_encode($res);
	}

	public function eliminar($placa){

		$vehiculo = $this->vehiculos->ver($placa);
		if(isset($vehiculo['placa']))
        {
            $this->vehiculos->eliminar($placa);
            redirect('vehiculo');
        } else
            show_error('El vehículo que estas intentando borrar no existe.');
	}

	// Cargar con AJAX
	public function mostrarModelosDeMarca($marca){
		$this->data['modelos'] = $this->modelo->verModelosDeMarca($marca);
		$this->load->view('componentes/combo/modelosMarcas',$this->data);
	}
    
    public function buscarAutosCliente($cliente){
        $this->data['vehiculos'] = $this->vehiculos->buscarVehiculosDeCliente($cliente);
        $this->load->view('vehiculos/combo_orden',$this->data);
    }

    public function verNombre($placa){
    	$this->data['contenido'] = $this->vehiculos->verVehiculoPlaca($placa);
    	$this->load->view('componentes/contParaNombres',$this->data);
	}
	
	public function autocompletarPlacas(){
        $vehiculos = $this->vehiculos->listar();
        foreach ($vehiculos as $v){
            $respuesta[$v['placa']] = null;
        }
        header('Content_type: application/json');
        echo json_encode($respuesta);
    }
}
