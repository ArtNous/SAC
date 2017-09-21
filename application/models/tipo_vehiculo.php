<?php
class Tipo_vehiculo extends CI_Model {

        public function __construct(){
                parent::__construct();
                $this->load->database();
        }

        public function ver($id)
        {
            return $this->db->get_where('TipoVehiculo', array('id'=>$id))->row_array();
        }

      
        public function crear($descripcion)
        {
            $query = $this->db->get_where('TipoVehiculo',array('descripcion'=>$descripcion));
            if($query -> num_rows() > 0){
              $res = false;
            } else {
              $res = true;
            }

             $data = array(
            'descripcion' => $descripcion,
          );

            $this->db->insert('TipoVehiculo', $data);
            return $res;
        }

        public function eliminar($id){
          $this->db->delete('TipoVehiculo', array('id' => $id));
        }

        public function actualizar($id,$nombre){
           $data = array(
            'descripcion' => $nombre
          );

          $this->db->where('id', $id);
          $this->db->update('TipoVehiculo', $data);
        }

        public function listar(){
          $this->db->order_by('id', 'asc');
          return $this->db->get('TipoVehiculo')->result_array();
        }
}
?>
