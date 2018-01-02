<?php  
require('application/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

Class Api extends REST_Controller {

	private $bds = array();

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->db->db_select($this->session->userdata('bd'));
		$this->load->helper('url');
		$this->bds = $this->session->userdata('bds');
	}

	public function clientes_get() {
		$this->load->model('clientes');
		$inicio = $this->input->get('start');
		$total = $this->input->get('count');
		$siguiente = $this->input->get('continue');
		
		if($inicio == 0){
			$res['total_count'] = $this->db->count_all('Clientes');
			echo json_encode($res);
			return false;
			// $res['data'] = $this->clientes->dameLote(1,$total);
			// $res['pos'] = 0;
		}

		$res['data'] = $this->clientes->dameLote($inicio,$total);
		$res['pos'] = $inicio;
		// echo json_encode($clientes);
		echo json_encode($res);
		return false;

		// $this->db->select('RIF,Nombre,RazonSocial,Direccion,Ciudad,Estado,Municipio,CodigoGrupo,Zona,');
		// $clientes = $this->db->get('Clientes')->result_array();
		// echo json_encode($clientes);
	}

	public function servicios_get() {
		$servicios = $this->db->get('Servicios')->result_array();
		echo json_encode($servicios);
	}

	public function ordenes_get() {
		// $this->db->select('OrdenServicio.*, Tecnicos.nombre as tec, Servicios.nombre as serv');
		$this->db->select('OrdenServicio.*, Tecnicos.nombre as tec, Servicios_orden.nombre as serv, Clientes.nombre as cliente');
		$this->db->from('OrdenServicio');
		$this->db->join('Tecnicos','Tecnicos.cedula = OrdenServicio.tecnico','left');
		$this->db->join('Servicios_orden','Servicios_orden.codigo = OrdenServicio.servicio','left');
		$this->db->join('Clientes','Clientes.CodigoCliente = OrdenServicio.cod_cliente','left');
		$this->db->order_by('OrdenServicio.nro_orden','DESC');
		$ordenes = $this->db->get()->result_array();
		echo json_encode($ordenes);
	}

	public function marcas_get() {
		$marcas = $this->db->get('Marca')->result_array();
		echo json_encode($marcas);
	}

	public function tipos_get() {
		$tipos = $this->db->get('TipoVehiculo')->result_array();
		echo json_encode($tipos);
	}

	public function modelos_get() {
		$this->db->select('Modelo.id, Modelo.nombre as modelo, Marca.nombre as marca');
		$this->db->from('Modelo');
		$this->db->join('Marca','Marca.id = Modelo.marca','left');
		$modelos = $this->db->get()->result_array();
		echo json_encode($modelos);
	}

	public function tecnicos_get() {
		$this->db->select('Tecnicos.*, Servicios_orden.nombre as servicio');
		$this->db->from('Tecnicos');
		$this->db->join('TecnicoServicio','TecnicoServicio.cedula_tecnico = Tecnicos.cedula','inner');
		$this->db->join('Servicios_orden','Servicios_orden.codigo = TecnicoServicio.servicio','inner');
		$tecnicos = $this->db->get()->result_array();
		echo json_encode($tecnicos);
	}

	public function vehiculos_get() {
		$this->db->select('Vehiculo.placa, Marca.nombre as marca, Modelo.nombre as modelo, TipoVehiculo.descripcion as tipo');
		$this->db->from('Vehiculo');
		$this->db->join('Marca','Marca.id = Vehiculo.marca','inner');
		$this->db->join('Modelo','Modelo.id = Vehiculo.modelo','inner');
		$this->db->join('TipoVehiculo','TipoVehiculo.id = Vehiculo.tipo_vehiculo','inner');
		$vehiculos = $this->db->get()->result_array();
		echo json_encode($vehiculos);
	}

	public function tiempos_get() {
		$this->db->select('Servicios_orden.codigo as cod_serv,Servicios_orden.nombre as servicio,TipoVehiculo.id as tipoid,TipoVehiculo.descripcion as tipo,TiempoAtencion.tiempo, TiempoAtencion.kilometraje');
		$this->db->from('TiempoAtencion');
		$this->db->join('Servicios_orden','Servicios_orden.codigo = TiempoAtencion.servicio','left');
		$this->db->join('TipoVehiculo','TipoVehiculo.id = TiempoAtencion.tipo_vehiculo','inner');
		$tiempos = $this->db->get()->result_array();
		echo json_encode($tiempos);
	}

	public function cola_post(){
		$servicio = $this->input->post('servicio');
		$this->db->select('OrdenServicio.nro_orden as id,OrdenServicio.placa,OrdenServicio.posicion_inicial,OrdenServicio.cod_cliente,OrdenServicio.servicio as srvcodigo, Servicios_orden.nombre as servicio, TiempoAtencion.tiempo');
		$this->db->from('OrdenServicio');
		$this->db->join('Servicios_orden','Servicios_orden.codigo = OrdenServicio.servicio','inner');
		$this->db->join('Vehiculo','Vehiculo.placa = OrdenServicio.placa','inner');
		$this->db->join('TiempoAtencion','Vehiculo.tipo_vehiculo = TiempoAtencion.tipo_vehiculo AND OrdenServicio.servicio = TiempoAtencion.servicio','inner');
		
		$this->db->where('OrdenServicio.estatus',2);
		$this->db->where('OrdenServicio.servicio',$servicio);
		$this->db->order_by('Servicios_orden.nombre','ASC');
		$this->db->order_by('OrdenServicio.posicion_inicial','ASC');
		$pendientes = $this->db->get()->result_array();
		echo json_encode($pendientes);
	}

	public function cola_activos_post(){
		$servicio = $this->input->post('servicio');
		$this->db->select('OrdenServicio.nro_orden,OrdenServicio.placa,OrdenServicio.posicion_inicial,OrdenServicio.cod_cliente,OrdenServicio.servicio as srvcodigo, Servicios_orden.nombre as servicio,TiempoAtencion.kilometraje as proxima,Vehiculo.km_actual,TiempoAtencion.tiempo as tiempo');
		$this->db->from('OrdenServicio');
		$this->db->join('Servicios_orden','Servicios_orden.codigo = OrdenServicio.servicio','inner');
		$this->db->join('Vehiculo','OrdenServicio.placa = Vehiculo.placa','inner');
		$this->db->join('TiempoAtencion','TiempoAtencion.tipo_vehiculo = Vehiculo.tipo_vehiculo AND TiempoAtencion.servicio = OrdenServicio.servicio','inner');
		$this->db->where('OrdenServicio.estatus',1);
		$this->db->where('OrdenServicio.servicio',$servicio);
		$this->db->order_by('Servicios_orden.nombre','ASC');
		$this->db->order_by('OrdenServicio.nro_orden','ASC');
		$activos = $this->db->get()->result_array();
		echo json_encode($activos);
	}

	public function progreso_activas_get(){
		$this->db->select('OrdenServicio.nro_orden as orden,OrdenServicio.placa,OrdenServicio.fecha_inicio as inicio,TiempoAtencion.kilometraje as km, Tecnicos.nombre as tecNombre, TiempoAtencion.tiempo, Servicios_orden.nombre as servicio');
		$this->db->from('OrdenServicio');
		$this->db->join('Servicios_orden','Servicios_orden.codigo = OrdenServicio.servicio','inner');
		$this->db->join('Vehiculo','Vehiculo.placa = OrdenServicio.placa','inner');
		$this->db->join('Tecnicos','Tecnicos.cedula = OrdenServicio.tecnico','inner');
		$this->db->join('TiempoAtencion','TiempoAtencion.tipo_vehiculo = Vehiculo.tipo_vehiculo AND Servicios_orden.codigo = TiempoAtencion.servicio','inner');
		$this->db->where('OrdenServicio.estatus',1);
		$activas = $this->db->get()->result_array();
		$res = array();
		date_default_timezone_set('America/Caracas');
		foreach($activas as $a){
			$inicioEl = new DateTime($a['inicio']);
			$inicioEl->add(new DateInterval('PT' . $a['tiempo'] .'M'));
			$a['termina'] = $inicioEl->format('d-m-Y g:i:s A'); // Cadena de la fecha que termina el servicio
			$transcurrido = $this->calcularTiempoTranscurrido($a['inicio'],date('Y-m-d H:i:s'));
			$a['minutos'] = $transcurrido->i;
			// Chequea si ya debio haber terminado el servicio
			$fin = new DateTime($inicioEl->format('Y-m-d H:i:s'));
			$ahora = new DateTime('now');
			if ($ahora > $fin) {
				$a['termino'] = 1;
			} else {
				$a['termino'] = 2;
			} // Fin de chequeo
			if ($transcurrido->d == 1){
				$a['transcurrido'] = $transcurrido->format('%d dia con %h horas y %i minutos');
			}
			else{
				$a['transcurrido'] = $transcurrido->format('%d dias con %h horas y %i minutos');
			}

			$res[] = $a;
		}
		echo json_encode($res);
	}

	// Calcula el tiempo que lleva activa la orden
	public function calcularTiempoTranscurrido($inicio,$final){
		$fechaI = new DateTime($inicio);
		$fechaF = new DateTime($final);
		$i = $fechaF->diff($fechaI,true);
		return $i;
	}

	// Reportes

	public function reporte_mes_post(){
		// Agrupados por dias
		$mes = $this->input->post('mes');
		if($mes == "") {
			return false;
		}
		$servicio = $this->input->post('servicio');
		$res = $this->db->query("SELECT o.servicio, DAY(o.fecha) AS DIA, count(o.nro_orden) AS CANTIDAD
			from OrdenServicio o
			join Servicios_orden s on s.codigo=o.servicio
			where o.servicio='". $servicio ."' AND  Month(fecha)=".$mes."
			GROUP BY o.servicio, DAY(o.fecha)");
		echo json_encode($res->result_array());
	}

	public function reporte_anio_post(){
		// Agrupados por mes
		$anio = $this->input->post('anio');
		$servicio = $this->input->post('servicio');
			$res = $this->db->query("SELECT o.servicio, month(o.fecha) AS mes, count(o.nro_orden) AS CANTIDAD
				from OrdenServicio o
				join Servicios_orden s on s.codigo=o.servicio
				where o.servicio='".$servicio."' AND  year(fecha)=".$anio."
				GROUP BY o.servicio, month(o.fecha)");
		echo json_encode($res->result_array());
	}

}

?>