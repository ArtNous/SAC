<?php
class Tiempos_modelo extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct(){
                parent::__construct();
                $this->load->database();
        }

        public function ver($servicio,$tipov)
        {
            return $this->db->get_where('TiempoAtencion',array('servicio'=>$servicio,'tipo_vehiculo'=>$tipov))->row_array();
        }

   
        public function crear($fila){
            $this->db->insert('TiempoAtencion', $fila);
            return $this->db->last_query();
        }

        public function eliminar($serv,$tipov){
          $this->db->delete('TiempoAtencion', array('servicio' => $serv,'tipo_vehiculo'=>$tipov));
        }

        public function actualizar($registro){
            $this->db->where('servicio',$registro['servicio']);
            $this->db->where('tipo_vehiculo',$registro['tipo_vehiculo']);
            $this->db->update('TiempoAtencion',$registro);
        }

        public function listar(){
          $this->db->order_by('tiempo', 'asc');
          return $this->db->get('TiempoAtencion')->result_array();
        }

        public function verTiemposServicio($servicio){
            $this->db->select('TipoVehiculo.descripcion as tipov,TipoVehiculo.id as id,TiempoAtencion.tiempo as tiempo, TiempoAtencion.servicio as servicio');
            $this->db->from('TiempoAtencion');
            $this->db->where('TiempoAtencion.servicio',$servicio);
            $this->db->join('TipoVehiculo','TipoVehiculo.id = TiempoAtencion.tipo_vehiculo','inner');
            $this->db->join('Servicios','Servicios.codigo = TiempoAtencion.servicio','inner');
            return $this->db->get()->result_array();
        }

}
?>
