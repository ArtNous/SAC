<?php 

Class Usuarios_mod extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function index(){

	}

	public function existeUsuario($usuario,$pass){
		$this->db->where('usuario',$usuario);
		$this->db->where('password',$pass);
		$query = $this->db->get('usuarios_orden');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function dameUsuario($usuario,$pass){
		if($this->existeUsuario($usuario,$pass)){
			return $this->db->get_where('usuarios_orden',array('usuario'=>$usuario,'password'=>$pass))->row_array();
		}
	}

	public function yaExisteElUsuario($usuario){
		$this->db->where('usuario',$usuario);
		$query = $this->db->get('usuarios_orden');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function agregarUsuario($usuario){
		$this->db->insert('usuarios_orden',$usuario);
	}
}

?>