<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {

    private $bds = array();
    
    private $bc_inicial = "Panel de configuración";
    private $bc_seccion = "Marcas";
    private $bc_crear = "Crear";
    private $crearUrl = "marcas/crear";
    private $urlEliminar = "marcas/eliminar";
    private $urlVer = "marcas/ver/";
    private $urlEditar = "marcas/editar/";
    private $data = array();

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->db->db_select($this->session->userdata('bd'));
        $this->load->model('marca');

        if(!($this->session->userdata('usuario') && ($this->session->userdata('rol') == 1))){
            redirect('acciones/noadmin');
        }       
        $this->bds = $this->session->userdata('bds');
        $this->data['bds'] = $this->bds;
	}
	// Muestra vista con lista de marcas disponibles
	public function index()
	{
        $this->data['css'] = array(
            'assets/css/materialize.min.css',
            'assets/css/estilos.css',
            'assets/css/configuracion/estilo.css',
            "assets/webix/skins/air.css",
        );
        $this->load->helper('form');
		$this->load->library('form_validation');
        
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
			array('url'=>base_url('marcas'),'nombre'=>'Marcas de vehículos'),);
        $this->data['urlCrear'] = $this->crearUrl;
        $this->data['titulo'] = 'Lista de Marcas';
        $this->data['nombre_ix'] = 'marcas';
        $this->data['tooltip'] = 'marca';


		$this->load->view('apertura',$this->data);
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('componentes/lista_webix',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);
	}

    public function crear(){
        $this->data['css'] = array(
            'assets/css/materialize.min.css',
            'assets/css/estilos.css',
            'assets/css/configuracion/estilo.css',
            "assets/webix/skins/air.css",
        );
        $this->data['niveles'] = array(
            array('url'=>base_url(''),'nombre'=>'Principal'),
            array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
            array('url'=>base_url('marcas/'),'nombre'=>'Marcas de vehículos'),
            array('url'=>base_url('marcas/crear'),'nombre'=>'Crear'),);

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nombre', 'marca', 'required|is_unique[marca.nombre]',
            array(
            'required' => 'El campo debe ser llenado',
            'is_unique' => 'La %s ya esta registrada',
        ));
        $this->form_validation->set_error_delimiters('<div class="error_form">','</div>');

        if ($this->form_validation->run() == FALSE)
        {
            $datos['marcas'] = $this->marca->listar();
            $this->load->view('apertura',$this->data);
            $this->load->view('header/principal');
            $this->load->view('main/principal',$this->data);
            $this->load->view('marcas/crear');
            $this->load->view('footer/principal');
            $this->load->view('cierre',$this->data);
        }
        else
        {
            // $this->news_model->set_news();
            $nombre = $this->input->post('nombre');
            $this->marca->crear($nombre);
            redirect('marcas');
        }
    }

    public function chequearCampo(){

    }
        
    public function editar($id){
        $this->data['scripts'] = array(
            'js/jquery-3.2.1.min.js',
            'js/materialize.min.js',
        );
        $this->data['niveles'] = array(
            array('url'=>base_url(),'nombre'=>'Principal'),
            array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
            array('url'=>base_url('marcas'),'nombre'=>'Marcas de vehículos'),
            array('url'=>"#!",'nombre'=>'Editar'),);

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'marca de vehículo', 'required');
        $this->form_validation->set_rules('nombre', 'marca de vehículo', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['marca'] = $this->marca->ver($id);
            $this->load->view('apertura');
            $this->load->view('header/principal');
            $this->load->view('main/principal',$this->data);
            $this->load->view('marcas/editar',$this->data);
            $this->load->view('footer/principal');
            $this->load->view('cierre',$this->data);
        }
        else
        {
            if (isset($_POST['marca'])){
                $nombre = $this->input->post('marca');
                $this->marca->actualizar($id,$nombre);
                redirect('marcas');
            }
        }
    }

    public function actualizar(){
        $this->data['scripts'] = array(
            'js/jquery-3.2.1.min.js',
            'js/materialize.min.js',
        );
    	$this->data['niveles'] = array(
            array('url'=>base_url(),'nombre'=>'Principal'),
            array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuración'),
            array('url'=>base_url('marcas'),'nombre'=>'Marcas de vehículos'),
            array('url'=>"#!",'nombre'=>'Editar'),);

    	$this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('nombre', 'nombre de la marca', 'required');

         if ($this->form_validation->run() == FALSE)
        {
            $this->data['marca'] = $this->marca->ver($this->input->post('id'));
            $this->load->view('apertura');
            $this->load->view('header/principal');
            $this->load->view('main/principal',$this->data);
            $this->load->view('marcas/editar',$this->data);
            $this->load->view('footer/principal');
            $this->load->view('cierre',$this->data);
        }
        else
        {
            if (isset($_POST['nombre'])){
            	$id = $this->input->post('id');
                $nombre = $this->input->post('nombre');
                $this->marca->actualizar($id,$nombre);
                redirect('marcas');
            }
        }
    }

	public function eliminar($id){

		$marca = $this->marca->ver($id);
		if(isset($marca['id']))
        {
            $this->marca->eliminar($id);
            redirect('marcas');
        } else
            show_error('La marca que estas intentando borrar no existe.');
	}
}
