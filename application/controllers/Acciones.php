<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

Class Acciones extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->db->db_select($this->session->userdata('bd'));
		$this->load->helper('url');
		$this->load->model('orden_modelo');
		$this->load->model('tecnicos_mod');
		$this->load->model('clientes');
		if(!$this->session->userdata('usuario')){
            redirect('auth/login');
        } 
        $this->bds = $this->session->userdata('bds');
	}

	public function cambiarBD(){
		$bd = $this->input->post('bd');
		$datos_sesion = array(
			"bd" => $bd,
		);
		$this->session->set_userdata($datos_sesion);;
		return true;
	}

	public function verModal($nro_orden,$servicio = null){
		$this->load->helper('form');
		$data['info'] = $this->orden_modelo->ficha($nro_orden);
		if($data['info']['tecnico'] == null){
			$data['info']['tecnico'] = "No tiene técnico asignado";
		}
		$data['cliente'] = $this->clientes->ver($data['info']['cod_cliente']);
		$data['contenido'] = "Orden de servicio";
		if(($servicio != null) && ($this->session->userdata('rol') == 1)) {
			$data['tecnicos'] = $this->tecnicos_mod->verPorServicio($servicio);
		}
		$this->load->view('modal',$data);
	}

	public function noAdmin(){
		$this->load->view('error/no_admin');
	}
}


?>