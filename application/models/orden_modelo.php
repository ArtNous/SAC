<?php
class Orden_modelo extends CI_Model {

    public function __construct(){
            parent::__construct();
            $this->load->database();
    }

    public function crear($orden)
    {
        $data = array(
            'cod_vendedor' => '001',
            'cod_cliente' => $orden['cliente'],
            'placa' => $orden['placa'],
            'fecha' => $orden['fecha'],
            'cod_vendedor' => '001',
            'servicio' => $orden['servicio'],
            'estatus' => $orden['estatus'],
            'posicion_inicial' => $orden['posicion_inicial'],
        );

        $this->db->insert('OrdenServicio', $data);
    }

    public function listar($orden = "nro_orden",$asc='DESC'){
        $this->db->order_by($orden,$asc);
        return $this->db->get('OrdenServicio')->result_array();
    }

    public function listarActivas($orden = "nro_orden",$asc='desc'){
        $this->db->select('OrdenServicio.*, Tecnicos.nombre as tecnico,TiempoAtencion.tiempo as tiempo');
        $this->db->join('Tecnicos','Tecnicos.cedula = OrdenServicio.tecnico','inner');
        $this->db->join('Vehiculo','Vehiculo.placa = OrdenServicio.placa','inner');
        $this->db->join('TiempoAtencion','TiempoAtencion.tipo_vehiculo = Vehiculo.tipo_vehiculo AND TiempoAtencion.servicio = OrdenServicio.servicio','inner');
        $this->db->where('OrdenServicio.estatus','1');
        $this->db->order_by($orden,$asc);
        return $this->db->get('OrdenServicio')->result_array();
    }

    public function listarPendientes(){
        $this->db->select('OrdenServicio.nro_orden as id, Servicios.nombre as servicio, OrdenServicio.placa as placa, TiempoAtencion.tiempo as tiempo, OrdenServicio.posicion_inicial as posicion');
        $this->db->from('OrdenServicio');
        $this->db->join('Servicios','Servicios.codigo = OrdenServicio.servicio','inner');
        $this->db->join('Vehiculo','Vehiculo.placa = OrdenServicio.placa','inner');
        $this->db->join('TiempoAtencion','Vehiculo.tipo_vehiculo = TiempoAtencion.tipo_vehiculo AND OrdenServicio.servicio = TiempoAtencion.servicio','inner');
        $this->db->where('OrdenServicio.estatus',2);

        $filas = $this->db->get()->result_array();
        return $filas;
    }

    public function ver($nro){
        $this->db->where('nro_orden', $nro);
        return $this->db->get('OrdenServicio')->row_array();
    }  
    
    public function verPorCodigo($codigo){
        $this->db->where('cod_cliente',$codigo);
        $query = $this->db->get('OrdenServicio');
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function verPorRif($rif){
        $this->db->where('cod_cliente',$rif);
        $query = $this->db->get('OrdenServicio');
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function verPorPlaca($placa){
        $this->db->where('placa',$placa);
        $query = $this->db->get('OrdenServicio');
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function verPorTecnico($cedula){
        $this->db->where('tecnico',$cedula);
        $query = $this->db->get('OrdenServicio');
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function eliminar($nro_orden){
        $this->db->select('posicion_inicial,servicio');
        $this->db->where('nro_orden',$nro_orden);
        $this->db->from('OrdenServicio');
        $orden = $this->db->get()->row_array();
        $servicio = $orden['servicio'];
        $posicion = $orden['posicion_inicial'];
        $this->db->where('nro_orden',$nro_orden);
        $this->db->delete('OrdenServicio');

      // Decrementa un puesto todas las ordenes siguientes
        $this->db->select('posicion_inicial,nro_orden');
        $this->db->where('estatus',2);
        $this->db->where('servicio',$servicio);
        $this->db->where('posicion_inicial >',$posicion);
        $cola = $this->db->get('OrdenServicio')->result_array();
        foreach($cola as $c){
        $modificacion = array(
            "posicion_inicial" => $c['posicion_inicial'] - 1,
        );
        $this->db->where('nro_orden',$c['nro_orden']);
        $this->db->update('OrdenServicio',$modificacion);
        }
    }

    public function ultimaPosicion($servicio,$fecha_inicio){
        $this->db->select_max('posicion_inicial','ultimo');
        $this->db->where('servicio',$servicio);
        $this->db->where('estatus','2'); // La orden este pendiente
        $this->db->where('fecha_inicio',$fecha_inicio); // La orden este pendiente
        $query = $this->db->get('OrdenServicio');
      
        if($query -> num_rows() > 0){
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function colaServicio($servicio){
        $this->db->select('OrdenServicio.placa as placa,
            OrdenServicio.nro_orden as nro,
            TiempoAtencion.tiempo as tiempo');
        $this->db->from('OrdenServicio');
        $this->db->join('Vehiculo','OrdenServicio.placa = Vehiculo.placa','inner');
        $this->db->join('TiempoAtencion','TiempoAtencion.tipo_vehiculo = Vehiculo.tipo_vehiculo AND TiempoAtencion.servicio = OrdenServicio.servicio','inner');
        $this->db->where('OrdenServicio.servicio',$servicio);
        $this->db->where('OrdenServicio.estatus',2);
        return $this->db->get()->result_array();
    }

    public function estatusActiva($datos){
        // Chequea si hay tecnicos disponibles para ese servicio
        $this->db->query('SET DATEFORMAT ymd');
        $servicio = $datos['servicio'];
        $nro_orden = $datos['nroOrden'];

        // Chequea si existe la orden
        $orden = $this->db->get_where('OrdenServicio',array('nro_orden'=>$nro_orden,'estatus'=>2));

        if($orden->num_rows() > 0) {
            // Existe
            if($orden->row_array()['posicion_inicial'] != 1){
                return 8; // NO LE TOCA EL TURNO
            }
            $this->db->select('tecnico');
            $tecnicos_activas = $this->db->get_where('OrdenServicio',array('estatus'=>1));
            $ocupados = array();
            foreach($tecnicos_activas->result_array() as $t){
                $ocupados[] = $t['tecnico'];
            }
            if($tecnicos_activas -> num_rows() == 0) { // ¿hay tecnicos activos?
                // No
                $this->db->select('TecnicoServicio.cedula_tecnico as tecnico');
                $this->db->order_by('Tecnicos.nombre');
                $this->db->join('Tecnicos','Tecnicos.cedula = TecnicoServicio.cedula_tecnico','inner');
                $filas = $this->db->get_where('TecnicoServicio',array('servicio'=>$servicio))->result_array();
                $tecnico_establecido = $filas[0]; // Escoge el primer tecnico ordenado por nombre
                $this->establecerTecnico($tecnico_establecido['tecnico'],$nro_orden);
                $data = array('estatus'=>1,'fecha_inicio'=>$datos['fecha_inicio']);
                $this->db->where('nro_orden',$nro_orden);
                $this->db->update('OrdenServicio',$data);

                // Ahora busca todas las ordenes de ese servicio que esten pendiente
                // y le disminuye en uno su posicion_inicial
                $this->db->select('posicion_inicial,nro_orden');
                $cola = $this->db->get_where('OrdenServicio',array('estatus'=>2,'servicio'=>$servicio))->result_array();
                foreach($cola as $c){
                    $modificacion = array(
                        "posicion_inicial" => $c['posicion_inicial'] - 1,
                    );
                    $this->db->where('nro_orden',$c['nro_orden']);
                    $this->db->update('OrdenServicio',$modificacion);
                }
                return 1;
            } else {
                // Busca los demas tecnicos que prestan ese servicio
                // Y le coloca el primero que encuentre
                $this->db->select('cedula_tecnico as tecnico');
                $this->db->from('TecnicoServicio');
                $this->db->where_not_in('cedula_tecnico',$ocupados);
                $this->db->where('servicio',$servicio);
                $tecnicosDisponibles = $this->db->get();
                if($tecnicosDisponibles -> num_rows() > 0){ // Hay tecnicos disponibles
                    // Si hay mas tecnicos, le establece uno
                    $this->establecerTecnico($tecnicosDisponibles->result_array()[0]['tecnico'],$nro_orden);
                    $data = array('estatus'=>1,'fecha_inicio'=>$datos['fecha_inicio']);
                    $this->db->where('nro_orden',$nro_orden);
                    
                    $this->db->update('OrdenServicio',$data);
                    // Ahora busca todas las ordenes de ese servicio que esten pendiente
                    // y le disminuye en uno su posicion_inicial
                    $this->db->select('posicion_inicial,nro_orden');
                    $cola = $this->db->get_where('OrdenServicio',array('estatus'=>2,'servicio'=>$servicio))->result_array();
                    foreach($cola as $c){
                        $modificacion = array(
                            "posicion_inicial" => $c['posicion_inicial'] - 1,
                        );
                        $this->db->where('nro_orden',$c['nro_orden']);
                        $this->db->update('OrdenServicio',$modificacion);
                    }
                    return 7;
                } else {
                    // No hay tecnicos, debe esperar o cerrar la orden activa correspondiente

                    return 5;
                }
            }

        } else {
            return 15; // No existe esa orden de servicio
        }
    }

    public function finalizarOrden($nro_orden){
        $this->db->where('nro_orden',$nro_orden);        
        $fecha = date('Y-m-d H:m:s');
        $this->db->query('SET DATEFORMAT ymd');
        $this->db->update('OrdenServicio',array('estatus'=>3,'fecha_final'=>$fecha,'tecnico'=>null));
    }

    public function anularOrden($nro_orden){
        $orden =  $this->db->get_where('OrdenServicio',array('nro_orden'=>$nro_orden))->row_array();
        $servicio = $orden['servicio'];

        $this->db->where('nro_orden',$nro_orden);  
        $this->db->update('OrdenServicio',array('estatus'=>4));

        $this->db->select('posicion_inicial,nro_orden');
        $cola = $this->db->get_where('OrdenServicio',array('estatus'=>2,'servicio'=>$servicio))->result_array();
        foreach($cola as $c){
            $modificacion = array(
                "posicion_inicial" => $c['posicion_inicial'] - 1,
            );
            $this->db->where('nro_orden',$c['nro_orden']);
            $this->db->update('OrdenServicio',$modificacion);
        } 
    }

    public function establecerTecnico($tecnico,$orden) {
        $datos = array(
            'tecnico' => $tecnico,
        );
        $this->db->where('nro_orden',$orden);
        $this->db->update('OrdenServicio',$datos);
        $filas = $this->db->affected_rows();
        if($filas == 1){
            return true;
        } else {
            return false;
        }
    }

    public function ficha($orden){
        $this->db->select('
            OrdenServicio.nro_orden as orden,
            OrdenServicio.placa,
            OrdenServicio.cod_cliente,
            OrdenServicio.fecha,
            OrdenServicio.servicio as serv,
            OrdenServicio.fecha_inicio as inicio,
            OrdenServicio.posicion_inicial as posicion,
            OrdenServicio.estatus,
            OrdenServicio.tecnico as tec_ced,
            Marca.nombre as marca,
            Modelo.nombre as modelo,
            TipoVehiculo.descripcion as tipo,
            Servicios_orden.nombre as servicio,
            TiempoAtencion.tiempo,
            Tecnicos.nombre as tecnico');
        $this->db->from('OrdenServicio');
        $this->db->join('Vehiculo','Vehiculo.placa = OrdenServicio.placa','inner');
        $this->db->join('TipoVehiculo','Vehiculo.tipo_vehiculo = TipoVehiculo.id','inner');
        $this->db->join('Servicios_orden','Servicios_orden.codigo = OrdenServicio.servicio','inner');
        $this->db->join('TiempoAtencion','TiempoAtencion.tipo_vehiculo = Vehiculo.tipo_vehiculo AND Servicios_orden.codigo = TiempoAtencion.servicio','inner');
        $this->db->join('Marca','Vehiculo.marca = Marca.id','inner');
        $this->db->join('Modelo','Vehiculo.modelo = Modelo.id','inner');
        $this->db->join('Tecnicos','OrdenServicio.tecnico = Tecnicos.cedula','left');
        $this->db->where('nro_orden',$orden);
        $res = $this->db->get()->row_array();
        return $res;
    }

}
?>
