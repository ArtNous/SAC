<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiempos extends CI_Controller {

	private $bds = array();
	private $data = array();

	private $urlCrear = "tiempos/crear";
    private $urlEliminar = "tiempos/eliminar/";
    private $urlEditar = "tiempos/editar/";
    private $urlVer = "tiempos/ver/";

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->db->db_select($this->session->userdata('bd'));
		$this->load->model('tiempos_modelo');
		$this->load->model('servicio');
		$this->load->model('tipo_vehiculo');
		if(!($this->session->userdata('usuario') && ($this->session->userdata('rol') == 1))){
            redirect('acciones/noadmin');
        }   
        $this->bds = $this->session->userdata('bds');
	}
	// Muestra vista con lista de marcas disponibles
	public function index()
	{
		$this->data['bds'] = $this->bds;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
			array('url'=>base_url('tiempos'),'nombre'=>'Tiempos de atención'));
		
		$this->data['urlCrear'] = $this->urlCrear;
        $this->data['titulo'] = 'Lista de Tiempos de Servicios';
        $this->data['nombre_ix'] = 'tiempos';
        $this->data['tooltip'] = 'tiempo';

		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('componentes/lista_webix',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre');
	}

	public function crear($tipov = null, $servicio = null){
		$this->data['bds'] = $this->bds;
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
			array('url'=>base_url('tiempos/'),'nombre'=>'Tiempos de atención'),
			array('url'=>base_url('tiempos/crear'),'nombre'=>'Crear'),);

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('servicio', 'servicio', 'required',array('required'=>'El servicio debe ser elegido'));
		$this->form_validation->set_rules('tipo', 'Tipo de vehiculo', 'required',array('required'=>'El tipo de vehiculo debe ser elegido'));
		$this->form_validation->set_rules('tiempo', 'Tiempo de atención', 'required',array('required'=>''));
		$this->form_validation->set_rules('kilometraje', 'kilometraje', 'required',array('required'=>'El campo kilometraje debe ser llenado'));

		if(($tipov != null) && ($servicio != null)){
			$this->data['campos'] = $this->tiempos_modelo->ver($servicio,$tipov);
		}

	    if ($this->form_validation->run() == FALSE)
		{
			$this->data['servicios'] = $this->servicio->listar();
			$this->data['tipos'] = $this->tipo_vehiculo->listar();
 			$this->load->view('apertura');
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('tiempos_atencion/crear',$this->data);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else
	    {
	        $fila['kilometraje'] = $this->input->post('kilometraje');	
	        $fila['servicio'] = $this->input->post('servicio');	
	        $fila['tipo_vehiculo'] = $this->input->post('tipo');
	        $this->input->post('tiempo_largo') == "" ? $fila['tiempo'] = $this->input->post('tiempo') : $fila['tiempo'] = $this->input->post('tiempo_largo');
	        // $fila['tiempo'] = $this->input->post('tiempo');
	        if(($tipov != null) && ($servicio != null)){
		        $this->tiempos_modelo->actualizar($fila);
		        redirect('tiempos');
			}
	        $this->tiempos_modelo->crear($fila);
	        redirect('tiempos');
	    }
	}

	public function ver($servicio) {
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
			array('url'=>base_url('tiempos'),'nombre'=>'Tiempos de atención'),
			array('url'=>base_url('tiempos'),'nombre'=>'Ver'));
		
		$this->data['filas'] = $this->servicio->listar();
		$this->data['btnCrearUrl'] = $this->urlCrear;
        $this->data['urlEliminar'] = $this->urlEliminar;
        $this->data['urlEditar'] = $this->urlEditar;
        $this->data['urlVer'] = $this->urlVer;

        $this->data['ver'] = true;
        $this->data['editar'] = false;
        $this->data['eliminar'] = false;

        $datos['tiempos'] = $this->tiempos_modelo->verTiemposServicio($servicio);

		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('tiempos_atencion/tiempos_lista',$datos);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);
	}

	public function eliminar($serv,$tipov){

		$tiempo = $this->tiempos_modelo->ver($serv,$tipov);
		if(isset($tiempo['servicio']))
        {
            $this->tiempos_modelo->eliminar($serv,$tipov);
            redirect('tiempos');
        } else
            show_error('El tiempo de atencion que estas intentando borrar no existe.');
	}
}
