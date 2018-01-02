<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Caracas');

class Orden extends CI_Controller {

	private $bds = array();

	private $bc_crear = "Crear";
	private $bc_inicial = "Orden de servicio";
    private $bc_seccion = "Buscar";
    private $crearUrl = "orden/crear";
    private $urlEliminar = "orden/eliminar";
    private $data = array();

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->db->db_select($this->session->userdata('bd'));
		$this->load->model('orden_modelo');
		$this->load->model('servicio');
		$this->load->model('tecnicos_mod');
		$this->load->model('clientes');
		$this->load->model('vehiculos');
		if(!$this->session->userdata('usuario')){
            redirect('auth/login');
        }  
        $this->bds = $this->session->userdata('bds');
	}
	public function index()
	{
		$this->data['css'] = array(
			"assets/css/materialize.min.css",
			"assets/css/estilos.css",
			// "assets/css/dragula.min.css",
			"assets/css/configuracion/estilo.css",
			// "assets/webix/webix.css",
			"assets/webix/skins/air.css",
			// "assets/css/sweetalert2.min.css",
			"assets/css/form_cliente.css",
		);
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('orden'),'nombre'=>$this->bc_inicial),);

		$this->data['urlCrear'] = $this->crearUrl;
		$this->data['titulo'] = 'Lista de Ordenes de Servicios';
		$this->data['nombre_ix'] = 'ordenes';
		$this->data['tooltip'] = 'orden';
		$this->data['bds'] = $this->bds;

		$this->load->view('apertura',$this->data);
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('componentes/lista_webix',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);
	}

	public function crear(){
		$this->data['css'] = array(
			"assets/css/materialize.min.css",
			"assets/css/estilos.css",
			// "assets/css/dragula.min.css",
			"assets/css/configuracion/estilo.css",
			// "assets/webix/webix.css",
			"assets/webix/skins/air.css",
			// "assets/css/sweetalert2.min.css",
			"assets/css/form_cliente.css",
		);
		$this->data['bds'] = $this->bds;
	
		$this->data['niveles'] = array(
			array('url'=>base_url('orden'),'nombre'=>'Principal'),
			array('url'=>base_url('orden'),'nombre'=>$this->bc_inicial),
			array('url'=>base_url('orden/crear'),'nombre'=>$this->bc_crear),);

		$this->load->helper('form');
		$this->load->library('form_validation');

		// Reglas de validación de formulario
		$this->form_validation->set_rules('cliente', 'codigo del cliente', 'required',array(
			'required' => 'El campo debe ser llenado'
		));
		$this->form_validation->set_rules('placa', 'placa del vehículo', 'required',array(
			'required' => 'El campo debe ser llenado'
		));
		$this->form_validation->set_rules('servicio', 'servicio de la orden', 'required',array(
			'required' => 'El campo debe ser llenado'
		));
		$this->form_validation->set_rules('km_actual', 'Kilometraje actual del vehículo', 'required',array(
			'required' => 'El campo debe ser llenado'
		));
		$this->form_validation->set_error_delimiters('<div class="error_form_orden">','</div>');

	    if ($this->form_validation->run() == FALSE)
		{
			$datos['servicios'] = $this->servicio->listar();
			$datos['tecnicos'] = $this->tecnicos_mod->listar();
			$datos['placas'] = $this->vehiculos->listar();
			$this->load->view('apertura',$this->data);
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('orden/crear',$datos);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else
	    {
	    	$kilometraje = $this->input->post('km_actual');
	    	$fecha_inicio = $this->input->post('fecha_inicio');
	        $orden['cliente'] = $this->input->post('cliente');
	        $orden['placa'] = $this->input->post('placa');
	        $orden['fecha'] = date('Y/m/d');
	        $orden['servicio'] = $this->input->post('servicio');
	        $orden['estatus'] = 2; // Pendiente por defecto, se activa cuando se inicia
			// $orden['tecnico'] = $this->input->post('tecnico');
			
			// Chequea las ultimas ordenes registradas para ver que
			// posicion le toca
			$ultimaPos = $this->orden_modelo->ultimaPosicion($orden['servicio'],$fecha_inicio);
			print_r($ultimaPos);
			// Si no hay cola, lo coloca de primero
			if($ultimaPos['ultimo'] == null) {
		        $orden['posicion_inicial'] = 1;				
			} else {
		        $orden['posicion_inicial'] = $ultimaPos['ultimo'] + 1;
			}

			$this->orden_modelo->crear($orden);
			$this->vehiculos->modificarKilometraje($orden['placa'],$kilometraje);
            redirect('orden/crear');
	    }
	}

	
	public function buscar(){
		
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('orden'),'nombre'=>$this->bc_inicial),
			array('url'=>'#!','nombre'=>$this->bc_seccion),);

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['lista'] = "";

		if(isset($_POST['codigo'])){
			$codigo = $this->input->post('codigo');
			$placa = $this->input->post('placa');
			if($codigo == ""){
				$this->form_validation->set_rules('placa', 'placa del cliente', 'required');
			} else {
				$this->form_validation->set_rules('codigo', 'codigo del cliente', 'required');
			}
		}

		// Muestra formulario de busqueda
	    if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('apertura');
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('orden/buscar',$this->data);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
		}
	    else
	    {
			$this->data['urlEliminar'] = "orden/eliminar/";
			if($codigo != ""){
				$this->data['filas'] = $this->orden_modelo->verPorCodigo($codigo);
				if($this->data['filas'] == false) {
					$lista = "<h3>No hay registros para el código ". $codigo ."</h3>";
				} else {
					$lista = $this->load->view('componentes/lista_ordenes',$this->data,true);
				}
			} else {
				$placa = $this->input->post('placa');
				$this->data['filas'] = $this->orden_modelo->verPorPlaca($placa);
				if($this->data['filas'] == false) {
					$lista = "<h3>No hay registros para la placa ". $placa ."</h3>";
				} else {
					$lista = $this->load->view('componentes/lista_ordenes',$this->data,true);
				}
			}
			$this->data['lista'] = $lista;
			$this->load->view('apertura');
			$this->load->view('header/principal');
			$this->load->view('main/principal',$this->data);
			$this->load->view('orden/buscar',$this->data);
			$this->load->view('footer/principal');
			$this->load->view('cierre',$this->data);
	    }
	}

	public function buscarPorCliente($rif = null){
		if($rif == null) {
			return false;
		} 
		$this->data['filas'] = $this->orden_modelo->verPorRif($rif);
		$this->data['urlEliminar'] = 'orden/eliminar';
		$this->load->view('componentes/lista_ordenes',$this->data);
	}

	public function buscarPorPlaca($placa = null){
		if($placa == null) {
			return false;
		}

		$this->data['filas'] = $this->orden_modelo()->verPorPlaca($placa);
		$this->load->view('componentes/lista_ordenes',$this->data);
	}

	public function ultimas(){
		
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('orden'),'nombre'=>'Ordenes de servicio'),
			array('url'=>base_url('orden/ultimas'),'nombre'=>'Ultimas'),);

		$this->data['filas'] = $this->orden_modelo->listar("nro_orden","DESC");
		$this->data['btnCrearUrl'] = $this->crearUrl;
        $this->data['urlEliminar'] = $this->urlEliminar;
		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('orden/lista',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);
	}

	public function eliminar($nro){
		print_r($this->orden_modelo->eliminar($nro));
		redirect('orden/ultimas');
	}

	public function ficha($nro){
		
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('orden'),'nombre'=>$this->bc_inicial),
			array('url'=>base_url('orden/ultimas'),'nombre'=>'Ultimas'),
			array('url'=>"#!",'nombre'=>'Ficha'),);

		$this->data['orden'] = $this->orden_modelo->ver($nro);
		$this->data['cliente'] = $this->clientes->ver($this->data['orden']['cod_cliente']);
		$this->data['servicio'] = $this->servicio->ver($this->data['orden']['servicio']);
		$this->data['tecnico'] = $this->tecnicos_mod->ver($this->data['orden']['tecnico']);
		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('orden/ficha',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);
	}

	public function panel(){
		
		$this->data['niveles'] = array(
			array('url'=>base_url(''),'nombre'=>'Principal'),
			array('url'=>base_url('orden'),'nombre'=>$this->bc_inicial),
			array('url'=>base_url('orden/ultimas'),'nombre'=>'Panel'),);

		$this->data['ordenes'] = $this->orden_modelo->listarActivas('posicion_inicial','asc');
		
		$this->data['filas'] = $this->orden_modelo->listar('posicion_inicial','asc');
		$this->data['btnCrearUrl'] = $this->crearUrl;
        $this->data['urlEliminar'] = $this->urlEliminar;
		$this->data['ordenes_activas'] = $this->load->view('orden/orden_activa',$this->data,true);
		$this->load->view('apertura');
		$this->load->view('header/principal');
		$this->load->view('main/principal',$this->data);
		$this->load->view('orden/panel',$this->data);
		$this->load->view('footer/principal');
		$this->load->view('cierre',$this->data);
	}

	public function verPanel(){
		$activas = $this->orden_modelo->listarActivas();
		header("Content-type: application/json");
		echo json_encode($activas);
	}

	public function verTecnicosServicio($servicio){
		$this->data['tecnicos'] = $this->tecnicos_mod->verPorServicio($servicio);
		$this->load->view('tecnicos/comboorden',$this->data);
	}
	
	public function verOcupacionTecnicos($servicio){
		$this->data['tecnicos'] = $this->tecnicos_mod->verPorServicio($servicio);
		$this->data['tecnicos']['ordenes'] = $this->orden_modelo->verPorTecnico();
		$this->load->view('orden/ocupacion',$this->data);
	}

	public function verColasDeServicios(){
		$res = $this->orden_modelo->listarPendientes();
		header('Content-type: application/json');
		echo json_encode($res);
	}

	public function verColaJSON(){
		$servicio = $this->input->post('servicio');
		$ordenes = $this->orden_modelo->colaServicio($servicio);
		echo json_encode($ordenes);
	}

	public function iniciarOrden(){
		$datos = array(
			'nroOrden' => $this->input->post('orden'),
			'fecha_inicio' => date('Y-m-d H:i:s'),
			// 'fecha_inicio' => mdate($formatoFecha,$ahora),
			'servicio' => $this->input->post('servicio'),
		);
		$res = $this->orden_modelo->estatusActiva($datos);
		header('Content-type: plain/text');
		echo $res;
	}

	public function cambiarTecnicoDeOrden(){
		$tec = $this->input->post('tecnico');
		$nro = $this->input->post('orden');

		echo $this->orden_modelo->establecerTecnico($tec,$nro);
	}

	public function finalizar(){
		$orden = $this->input->post('orden');
		$res = $this->orden_modelo->finalizarOrden($orden);
		return $res;
	}

	public function anular(){
		$orden = $this->input->post('nro');
		$this->orden_modelo->anularOrden($orden);
		return true;
	}

	public function modificarCola(){
		$cola = json_decode($this->input->post('cola'));
		foreach ($cola as $indice => $orden) {
			$this->orden_modelo->modificarPosicion($orden,$indice+1);
		}
		return true;
	}

}
