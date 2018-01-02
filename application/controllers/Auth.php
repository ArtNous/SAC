<?php  

Class Auth extends CI_Controller {

	private $bds = array();

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->db->db_select($this->session->userdata('bd'));
		$this->load->dbutil();
		$this->bds = $this->dbutil->list_databases();
		// foreach ($this->bds as $stringBD) {
		// 	$lugar = stripos($stringBD,"emp");
		// 	if($lugar != false){
				
		// 	}
		// }
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="error-form">', '</span>');
		$this->load->model('usuarios_mod');
		$this->bds = $this->session->userdata('bds');
	}

	public function registrar($msj = null) {
		if($msj != null){
			$data['msj'] = $msj;
		}
		$data['titulo'] = 'Registro de cliente';
		$this->load->view('main/registrar',$data);
	}

	public function login($msj = null) {
		$datos['titulo'] = 'Inicio de sesión';
		if($msj != null) {
			$datos['msj'] = $msj;
		}
		$this->load->view('main/login',$datos);
	}

	public function validacion(){
		$this->form_validation->set_rules('usuario','nombre de usuario','required');
		$this->form_validation->set_rules('pass','contraseña','required');

		if ($this->form_validation->run() == FALSE) {
			
			$this->login();
		} else {
			$usuario = $this->input->post('usuario');
			$pass = $this->input->post('pass');

			$existe = $this->usuarios_mod->existeUsuario($usuario,sha1($pass));
			if ($existe){
				$datosUsuario = $this->usuarios_mod->dameUsuario($usuario,sha1($pass));
				$datos_sesion = array(
					"usuario" => $usuario,
					"email" => $datosUsuario['email'],
					"rol" => $datosUsuario['rol'],
					"bds" => $this->bds,
					"bd" => 'Empresa001',
				);

				$this->session->set_userdata($datos_sesion);
				redirect(base_url() . 'auth/ingreso');
			} else {
				$this->session->set_flashdata('error','Usuario o contraseña invalida');
				redirect(base_url() . 'auth/login');
			}

		}
	}

	public function validacion_reg($url = null){
		$this->form_validation->set_rules('cedula','cedula','required',array('required'=>'El campo cedula debe ser llenado.'));
		$this->form_validation->set_rules('usuario','nombre de usuario','required',array('required'=>'El campo usuario debe ser llenado'));
		$this->form_validation->set_rules('pass','contraseña','required',array('required'=>'El campo contraseña debe ser llenado.'));
		$this->form_validation->set_rules('rol','Rol','required',array('required'=>'El campo rol debe ser seleccionado.'));

		if ($this->form_validation->run() == FALSE) {
			$this->registrar();
		} else {
			$cedula = $this->input->post('cedula');
			$usuario = $this->input->post('usuario');
			$email = $this->input->post('email');
			$pass = $this->input->post('pass');
			$rol = $this->input->post('rol');

			$usuarioReg = array(
				'usuario' => $usuario,
				'cedula' => $cedula,
				'email' => $email,
				'password' => sha1($pass),
				'rol' => $rol,
			);
			$existe = $this->usuarios_mod->yaExisteElUsuario($usuario);
			if($existe){
				$this->registrar("El usuario ya existe, debe ingresar uno diferente a " . $usuario);
				return false;
			}
			$this->usuarios_mod->agregarUsuario($usuarioReg);
			$msj = 'Creado usuario exitosamente.';
			if($url != null) {
				redirect($url);
			}
			$this->login($msj);
		}
	}

	public function ingreso(){
		if($this->session->userdata('usuario') == ""){
			redirect(base_url() . 'auth/login');
		} else {
			redirect(base_url('orden/crear'));
		}
	}

	public function logout(){
		$this->session->unset_userdata('usuario');
		redirect(base_url() . 'auth/login');
	}
}

?>