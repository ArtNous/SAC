<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	private $bds = array();
	private $data = array();
    
    private $bc_inicial = "Clientes";
    private $bc_crear = "Crear";
    private $bc_buscar = "Buscar";
    private $vista = "";
    private $cliente;
    private $urlEliminar = "vehiculo/eliminar";

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->db->db_select($this->session->userdata('bd'));
		$this->load->helper('form');
		$this->load->model('clientes');
		$this->load->model('vehiculos');
		if(!$this->session->userdata('usuario')){
            redirect('auth/login');
        }   
        $this->bds = $this->session->userdata('bds');
	}

	public function index()
	{
		$this->data['niveles'] = array(
			array('url'=>base_url('orden'),'nombre'=>'Principal'),
			array('url'=>base_url('cliente'),'nombre'=>$this->bc_inicial),);

		$this->data['ver'] = true;
        $this->data['editar'] = true;
        $this->data['eliminar'] = true;

        $this->data['bds'] = $this->bds;

		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('clientes/principal');
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);
	}

	public function paraCombo(){
		$codigo = $this->input->post('valor');
		$cedulas = $this->clientes->dameSimilares($codigo);
		foreach ($cedulas as $c) {
			$res[$c['CodigoCliente']] = null;
		}
		echo json_encode($res);
	}

	public function paraComboNombre(){
		$nombre = $this->input->post('valor');
		$nombre = $this->clientes->dameNombresSimilares($nombre);
		foreach ($nombre as $n) {
			$res[$n['Nombre']] = null;
		}
		echo json_encode($res);
	}

	public function crear($rif = null){

		$this->data['bds'] = $this->bds;
		
		if($rif == null){
			$this->data['opcion'] = 1; // crear
		} else {
			$this->data['opcion'] = 2; // Modificar
			// Consulta todos los datos de ese cliente
			$this->data['cliente'] = $this->clientes->ver($rif);
		}
		$this->data['niveles'] = array(
			array('url'=>base_url('orden'),'nombre'=>'Principal'),
			array('url'=>base_url('cliente'),'nombre'=>$this->bc_inicial),
			array('url'=>base_url('cliente/crear'),'nombre'=>$this->bc_crear),);

		// $this->data['ciudades'] = ;
		// $this->data['estados'] = ;
		// $this->data['municipios'] = ;

		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('codigo', 'codigo del cliente', 'trim|required');
		$this->form_validation->set_rules('nombre', 'nombre del cliente', 'trim|required');
		$this->form_validation->set_rules('rif', 'rif del cliente', 'trim|required');
		$this->form_validation->set_rules('zona', 'zona del cliente', 'trim|required');
		$this->form_validation->set_rules('direccion', 'dirección del cliente', 'trim|required');
		$this->form_validation->set_rules('grupo', 'grupo del cliente', 'trim|required');
		$this->form_validation->set_rules('tlf', 'teléfono', 'trim|required|numeric');

		$this->form_validation->set_message('required','El campo {field} debe ser llenado.');

		$cliente['CodigoCliente'] = $this->input->post('codigo');
		$cliente['Nombre'] = $this->input->post('nombre');
		$cliente['RazonSocial'] = $this->input->post('razonS');
		$cliente['RIF'] = $this->input->post('rif');
		$cliente['Direccion'] = $this->input->post('direccion');
		$cliente['CodigoGrupo'] = $this->input->post('grupo');
		$cliente['Telefonos'] = $this->input->post('tlf');
		$cliente['Estado'] = $this->input->post('estado');

		$cliente['Ciudad'] = $this->input->post('ciudad');
		$cliente['Municipio'] = $this->input->post('municipio');
		$cliente['CodigoGrupo'] = $this->input->post('grupo');
		$cliente['Zona'] = $this->input->post('zona');

		// Definiendo los select del formulario

		$ciudades = $this->clientes->verCiudades();
		$this->data['ciudades'][''] = 'Seleccione la ciudad';
		foreach ($ciudades as $c) {
			$this->data['ciudades'][$c['Codigo']] = $c['Nombre'];
		}

		$estados = $this->clientes->verEstados();
		$this->data['estados'][''] = 'Seleccione el estado';
		foreach($estados as $e){
			$this->data['estados'][$e['Codigo']] = $e['Nombre'];
		}

		$municipios = $this->clientes->verMunicipios();
		$this->data['municipios'][''] = 'Seleccione el municipio';
		foreach($municipios as $m){
			$this->data['municipios'][$m['Codigo']] = $m['Nombre'];
		}

		$zonas = $this->clientes->verZonas();
		$this->data['zonas'][''] = 'Seleccione la zona';
		foreach($zonas as $z){
			$this->data['zonas'][$z['Codigo']] = $z['Nombre'];
		}
		
		$grupos = $this->clientes->verGrupos();
		$this->data['grupos'][''] = 'Seleccione el grupo';
		foreach($grupos as $g){
			$this->data['grupos'][$g['CodigoGrupo']] = $g['Nombre'];
		} // FIN DE LA DEFINICION

	    if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('apertura');
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			if($this->data['opcion'] == 1){
				$this->load->view('clientes/crear');
			} else {
				$this->load->view('clientes/crear',$this->data);
			}
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else
	    {
			if($this->data['opcion'] == 1) {
		        $this->clientes->crear($cliente);
			} else {
		        $this->clientes->actualizar($cliente);
			}
	        redirect('cliente');
	    }
	}

	public function editar($rif){
		
		$this->data['niveles'] = array(
			array('url'=>base_url('orden'),'nombre'=>'Principal'),
			array('url'=>base_url('cliente'),'nombre'=>$this->bc_inicial),
			array('url'=>base_url('cliente/buscar'),'nombre'=>$this->bc_buscar),);
		
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('codigo', 'codigo del cliente', 'required');
		$this->form_validation->set_rules('rif', 'rif del cliente', 'required');
		$this->form_validation->set_rules('direccion', 'dirección del cliente', 'required');
		$this->form_validation->set_rules('nit', 'nit', 'required');
		$this->form_validation->set_rules('zona', 'zona del cliente', 'required');
		$this->form_validation->set_rules('codContable', 'Codigo contable', 'required');
		$this->form_validation->set_rules('codGrupo', 'código del grupo', 'required');

	    if ($this->form_validation->run() == FALSE)
		{
			$this->data['cliente'] = $this->cliente;
			$this->load->view('apertura');
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('clientes/ficha',$this->data);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else
	    {
	    	$cliente['CodigoCliente'] = $this->input->post('codigo');
	    	$cliente['RIF'] = $this->input->post('rif');
	    	$cliente['NIT'] = $this->input->post('nit');
	    	$cliente['zona'] = $this->input->post('zona');
	    	$cliente['RazonSocial'] = $this->input->post('razonS');
	    	$cliente['Direccion'] = $this->input->post('direccion');
	    	$cliente['DireccionEnvio'] = $this->input->post('direccionE');
	    	$cliente['Ciudad'] = $this->input->post('ciudad');
	    	$cliente['Estado'] = $this->input->post('estado');
	    	$cliente['Municipio'] = $this->input->post('municipio');
	    	$cliente['email'] = $this->input->post('email');
	    	$cliente['Telefonos'] = $this->input->post('tlf');
	    	$cliente['Fax'] = $this->input->post('fax');
	    	$cliente['CodigoGrupo'] = $this->input->post('codGrupo');
	    	$cliente['Estatus'] = $this->input->post('estatus');
	    	if($cliente['Estatus'] == 'Activo'){
	    		$cliente['Estatus'] = 1;
	    	} else {
	    		$cliente['Estatus'] = 0;
	    	}
	    	$cliente['Tarifa'] = $this->input->post('tarifa');
	    	$cliente['CodigoContable'] = $this->input->post('codContable');
	    	$cliente['DocumentoFiscal'] = $this->input->post('df');

	    	print_r($cliente);
	        $this->clientes->actualizar($cliente);
	        redirect('cliente');
	    }
	}

	public function eliminar($rif){
		$this->clientes->eliminar($rif);
		redirect('cliente');
	}
    
    public function autoCompletarPorCodigo(){
    	$codigo = $this->input->post('entrada');
        $clientes = $this->clientes->dameSimilares($codigo);
        foreach ($clientes as $c){
            $respuesta[$c['CodigoCliente']] = null;
        }
        header('Content_type: application/json');
        echo json_encode($respuesta);
    }

    public function autoCompletarPorNombre(){
        $clientes = $this->clientes->listar();
        foreach ($clientes as $c){
            $respuesta[$c['Nombre']] = null;
        }
        header('Content_type: application/json');
        echo json_encode($respuesta);
    }

	public function ver($rif){
		$this->data['cliente'] = $this->clientes->ver($rif);
		$this->load->view('clientes/muestraNombre',$this->data);
	}

	public function consultar(){
		header('Content-type: application/json');
		if($this->input->post('nombre') != null){
			$cliente = $this->clientes->verPorNombre($nombre);			
		}
		if($this->input->post('rif') != null){
			$cliente = $this->clientes->ver($rif);						
		}
		echo json_encode($cliente);
	}

	public function verPorNombre($nombre){
		$this->data['cliente'] = $this->clientes->verPorNombre($nombre);
		$this->load->view('clientes/muestraNombre',$this->data);
	}

	public function mostrarFicha($rif){
		
		$this->cliente = $this->clientes->ver($rif);
		$this->data['filas'] = $this->vehiculos->buscarVehiculosDeCliente($rif); 
		$this->data['cliente'] = $this->cliente;
		$this->data['urlEliminar'] = $this->urlEliminar;
		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->data['autos_vista'] = $this->load->view('componentes/lista_autos',$this->data,true);
		$this->load->view('clientes/ficha',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);
	}

	public function verificarCliente($rif){
		$query = $this->db->get_where('Clientes',array('RIF'=>$rif));
		$cliente['msj'] = 2;
		if( $query->num_rows() > 0 ) {
			$cliente = $query->row_array();
			$cliente['msj'] = 1;
			echo json_encode($cliente);
		} else {
			echo json_encode($cliente);
		}
	}

}
