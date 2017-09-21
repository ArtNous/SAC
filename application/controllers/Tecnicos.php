<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tecnicos extends CI_Controller {

    private $bds = array();

    private $bc_inicial = "Técnicos";
    private $bc_crear = "Crear";
    private $urlCrear = "tecnicos/crear";
    private $urlEliminar = "tecnicos/eliminar";
    private $urlEditar = "tecnicos/editar/";
    private $urlVer = "tecnicos/ver/";
    private $bc_buscar = "ficha";
    private $data = array();

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->db->db_select($this->session->userdata('bd'));
        $this->load->model('tecnicos_mod');
        $this->load->model('servicio');
        $this->load->model('tecnico_servicio');
        if(!$this->session->userdata('usuario')){
            redirect('auth/login');
        }  
        $this->bds = $this->session->userdata('bds');
    }
    public function index()
    {
      
        $this->data['bds'] = $this->bds;
		$this->load->library('form_validation');
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('tecnicos'),'nombre'=>$this->bc_inicial),);

        $this->data['urlCrear'] = $this->urlCrear;
        $this->data['titulo'] = 'Lista de Técnicos';
        $this->data['nombre_ix'] = 'tecnicos';
        $this->data['tooltip'] = 'técnico';

		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
        $this->load->view('componentes/lista_webix',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre');
	}

	public function crear($cedula = null){
      
        $this->data['bds'] = $this->bds;
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('tecnicos'),'nombre'=>$this->bc_inicial),
			array('url'=>base_url('tecnicos/crear'),'nombre'=>$cedula != null ? "Editar" : $this->bc_crear),);

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('cedula', 'cédula', 'required',array(
            'required' => 'El campo debe ser llenado'
        ));
		$this->form_validation->set_rules('nombre', 'nombre', 'required',array(
            'required' => 'El campo debe ser llenado'
        ));
		$this->form_validation->set_rules('servicios[]', 'servicios', 'required',array(
            'required' => 'El campo debe ser llenado'
        ));
        $this->form_validation->set_error_delimiters('<div class="error_form_orden">','</div>');

        if($cedula != null){
            $this->data['tecnico'] = $this->tecnicos_mod->ver($cedula);
            $this->data['tecnico']['servicios'] = $this->tecnico_servicio->verServicios($cedula);
        }

	    if ($this->form_validation->run() == FALSE)
		{
			$datos['tecnicos'] = $this->tecnicos_mod->listar();
			$datos['servicios'] = $this->servicio->listar();

			$this->load->view('apertura');
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('tecnicos/crear',$datos);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else
	    {
            $tecnico['nombre'] = $this->input->post('nombre');
            if($cedula != null){
                $tecnico['cedula'] = $cedula;
            } else {
                $tecnico['cedula'] = $this->input->post('cedula');
            }
            $tecnico['estatus'] = $this->input->post('estatus');
            $tecnico['codigoINT'] = $this->input->post('codigoINT');
            $servicios = $this->input->post('servicios[]');
            foreach($servicios as $s){
                $valor = array(
                    'servicio' => $s,
                    'cedula_tecnico' => $tecnico['cedula'],
                );
                if($cedula != null){
                    $this->tecnico_servicio->actualizarServicios($cedula,$valor);
                } else {
                    $this->tecnico_servicio->crear($valor);
                }
            }
            
            if ($tecnico['estatus'] == "") {
                $tecnico['estatus'] = "inactivo";
            }
            if($cedula != null){
    	        $this->tecnicos_mod->actualizar($tecnico);
                redirect('tecnicos');
                return true;
            }
            $this->tecnicos_mod->crear($tecnico);
            redirect('tecnicos');
	    }
	}

     public function editar($cedula){
        
        $this->data['niveles'] = array(
            array('url'=>base_url(),'nombre'=>'Principal'),
            array('url'=>base_url('tecnicos'),'nombre'=>$this->bc_inicial),
            array('url'=>'#','nombre'=>'Editar'),);

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cedula', 'id', 'required');
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('codigoINT', 'codigo INT', 'required');

        $this->data['servicios_tec'] = $this->tecnico_servicio->verServicios($cedula);
        $this->data['servicios'] = $this->servicio->listar();

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['tecnico'] = $this->tecnicos_mod->ver($cedula);
            $this->load->view('apertura');
            $this->load->view('header/principal');
            $this->load->view('main/principal',$this->data);
            $this->load->view('tecnicos/editar',$this->data);
            $this->load->view('footer/principal');
            $this->load->view('cierre',$this->data);
        }
        else
        {
            if (!isset($_POST['estatus'])){
                $estatus = "inactivo";
            } else {
                $estatus = $this->input->post('estatus');
            }
            $cedula = $this->input->post('cedula');
            $nombre = $this->input->post('nombre');
            $int = $this->input->post('codigoINT');
            $tecnico = array(
                'cedula'=>$cedula,
                'nombre'=>$nombre,
                'estatus'=> $estatus,
                'codigoINT'=>$int);
            $this->tecnicos_mod->actualizar($tecnico);
            redirect('tecnicos');
        }
    }

	public function eliminar($cedula){
        $this->db->delete('Tecnicos',array('cedula' => $cedula));
		$this->db->delete('TecnicoServicio',array('cedula' => $cedula));
		$this->index();
	}

    public function mostrarPorServicio(){
        header('Content-type: application/json');
        $s = $this->input->post('servicio');
        echo json_encode($this->tecnicos_mod->verPorServicio($s));
    }

}
