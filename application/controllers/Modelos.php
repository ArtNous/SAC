<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelos extends CI_Controller {

	private $bds = array();
	private $data = array();
    
    private $crearUrl = "modelos/crear";

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->db->db_select($this->session->userdata('bd'));
		$this->load->model('modelo');
		$this->load->model('marca');
		if(!($this->session->userdata('usuario') && ($this->session->userdata('rol') == 1))){
            redirect('acciones/noadmin');
        }   
        $this->bds = $this->session->userdata('bds');
	}
	// Muestra vista con lista de marcas disponibles
	public function index()
	{
		
		$this->load->library('form_validation');
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
			array('url'=>base_url('modelos'),'nombre'=>'Modelos de vehículos'));

        $this->data['urlCrear'] = $this->crearUrl;
        $this->data['titulo'] = 'Lista de Modelos';
        $this->data['nombre_ix'] = 'modelos';
        $this->data['tooltip'] = 'modelo';
        
        $this->data['bds'] = $this->bds;

		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('componentes/lista_webix',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre');
	}

	public function crear(){
		
		$this->data['bds'] = $this->bds;
		$this->data['niveles'] = array(
			array('url'=>base_url('orden'),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
			array('url'=>base_url('modelos/'),'nombre'=>'Modelos de vehículos'),
			array('url'=>base_url('modelos/crear'),'nombre'=>'Crear'),);

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nombre', 'modelo', 'required',array(
				'required' => 'El campo %s debe ser llenado'
			));
		$this->form_validation->set_rules('marca', 'Marca a la que pertenece', 'required',
			array(
				'required' => 'Se debe ingresar la %s'
			));
		$this->form_validation->set_error_delimiters('<div class="error_form">','</div>');

	    if ($this->form_validation->run() == FALSE)
		{
			$this->data['marcas'] = $this->marca->listar();
 			$this->load->view('apertura');
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('modelos/crear',$this->data);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else
	    {
	        // $this->news_model->set_news();
	        $nombre = $this->input->post('nombre');
	        $marca = $this->input->post('marca');
	        $this->modelo->crear($nombre,$marca);
	        redirect('modelos');
	    }
	}

	public function editar($id){
		
		$this->data['niveles'] = array(
			array('url'=>base_url('orden'),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
			array('url'=>base_url('modelos/'),'nombre'=>'Modelos de vehículos'),
			array('url'=>"#!",'nombre'=>'Editar'),);

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre', 'nombre del modelo', 'required');
		$this->form_validation->set_rules('marca', 'marca', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->data['modelo'] = $this->modelo->ver($id);
			$this->data['marcas'] = $this->marca->listar();
			// redirect('modelos');
 			$this->load->view('apertura');
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('modelos/editar',$this->data);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else
	    {
            if(isset($_POST['nombre'])){
                $nombre = $this->input->post('nombre');
                $marca = $this->input->post('marca');

            	$modelo = array(
            		'id' => $id,
            		'nombre' => $nombre,
            		'marca' => $marca,
            	);

                $this->modelo->actualizar($modelo);
                redirect('modelos');
            }
	    }
	}

	public function ver($id) {
		$this->data['scripts'] = array(
			'js/jquery-3.2.1.min.js',
			'js/materialize.min.js',
		);
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
			array('url'=>base_url('modelos/'),'nombre'=>'Modelos de vehículos'),
			array('url'=>"#!",'nombre'=>'Ver modelo'),);

		$this->data['modelo'] = $this->modelo->verMarca($id);
		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('modelos/ficha',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);

	}

	public function eliminar($id){

		$modelo = $this->modelo->ver($id);
		if(isset($modelo['id']))
        {
            $this->modelo->eliminar($id);
            redirect('modelos');
        } else
            show_error('El modelo que estas intentando borrar no existe.');
	}
    
    public function verModelosMarca($marca){
        $datos['modelos'] = $this->modelo->verModelosDeMarca($marca);
        $this->load->view('componentes/listaModelosPorMarca',$datos);
    }
}
