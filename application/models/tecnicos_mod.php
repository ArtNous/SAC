<?php
class Tecnicos_mod extends CI_Model {

        public function __construct(){
                parent::__construct();
                $this->load->database();
        }

         public function ver($cedula)
        {
            return $this->db->get_where('Tecnicos',array('cedula'=>$cedula))->row_array();
        }

        public function crear($tecnico){
          $this->db->insert('Tecnicos', $tecnico);
        }
   
        public function eliminar($cedula){
          $this->db->delete('Tecnicos', array('cedula' => $cedula));
        }
   
        public function actualizar($tecnico){
          $this->db->where('cedula', $tecnico['cedula']);
          $datos = array(
            "nombre" => $tecnico['nombre'],
            "estatus" => $tecnico['estatus'],
            "codigoINT" => $tecnico['codigoINT'],
          );
          $this->db->update('Tecnicos', $datos);
        }

        public function listar(){
          $this->db->order_by('nombre', 'asc');
          return $this->db->get('Tecnicos')->result_array();
        }

        public function verPorServicio($servicio){
          $this->db->select('Tecnicos.nombre,Tecnicos.cedula');
          $this->db->from('Tecnicos');
          $this->db->join('TecnicoServicio','TecnicoServicio.cedula_tecnico = Tecnicos.cedula');
          $this->db->where('TecnicoServicio.servicio',$servicio);
          return $this->db->get()->result_array();
        }

        public function verServicios($cedula){
          $this->db->select('Servicios.nombre');
          $this->db->from('Servicios');
          $this->db->join('TecnicoServicio','TecnicoServicio.servicio = Servicios.codigo','inner');
          $this->db->where('TecnicoServicio.cedula_tecnico',$cedula);
          return $this->db->get()->result_array();
        }

}
?>
