<?php

Class Inicio extends CI_Controller {

	private $titulo = null;

	public function __contruct(){
		parent::__contruct();
	}

	public function index(){
		$this->titulo = 'Ingreso al sistema';
		$datos['titulo'] = $this->titulo;
 		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->view('main/login',$datos);
	}

}


?>