<?php

Class Inicio extends CI_Controller {

	public function __contruct(){
		parent::__contruct();
	}

	public function index(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->view('main/login');
	}

}


?>