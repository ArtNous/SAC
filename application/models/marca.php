<?php
class Marca extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct(){
                parent::__construct();
                $this->load->database();
        }

        public function ver($id)
        {
            return $this->db->get_where('Marca',array('id'=>$id))->row_array();
        }

        public function crear($nombre){
          $data = array(
            'nombre' => $nombre
          );

          $this->db->insert('Marca', $data);
        }

  
        // Borrado de datos

        public function eliminar($id){
          $this->db->delete('Marca', array('id' => $id));
        }

        // Actualizar tablas

        public function actualizar($id,$nombre){
          $data = array(
            'nombre' => $nombre
          );

          $this->db->where('id', $id);
          $this->db->update('Marca', $data);
        }

        public function listar(){
          $this->db->order_by('nombre', 'asc');
          return $this->db->get('Marca')->result_array();
        }
    
}
?>
