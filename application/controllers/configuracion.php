<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller {

	private $bds = array();
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->db->db_select($this->session->userdata('bd'));
		$this->load->dbutil();
		$this->bds = $this->dbutil->list_databases();
	}
	public function index()
	{
		$data['bds'] = $this->bds;
		$data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('configuracion'),'nombre'=>'Panel de configuracion'),);
		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$data);
		$this->load->view('configuracion/principal',$data);
		$this->load->view('footer/principal');
		$this->load->view('cierre');
	}
}
