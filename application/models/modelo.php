<?php
class Modelo extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct(){
                parent::__construct();
                $this->load->database();
        }

         public function ver($id)
        {
            return $this->db->get_where('Modelo',array('id'=>$id))->row_array();
        }

        public function verMarca($id){
          $this->db->select('Modelo.nombre as modelo,Marca.nombre as marca');
          $this->db->from('Modelo');
          $this->db->join('Marca','Marca.id = Modelo.marca','inner');
          $this->db->where('Modelo.id',$id);
          return $this->db->get()->row_array();
        }

        public function verModelosDeMarca($marca){
          return $this->db->get_where('Modelo',array('marca'=>$marca))->result_array(); 
        }

        public function crear($nombre,$marca){
          $data = array(
            'nombre' => $nombre,
            'marca' => $marca,
          );

          $this->db->insert('Modelo', $data);
        }

   
        public function eliminar($id){
          $this->db->delete('Modelo', array('id' => $id));
        }

   
        public function actualizar($modelo){
          $data = array(
            'nombre' => $modelo['nombre'],
            'marca' => $modelo['marca'],
          );
          $this->db->where('id', $modelo['id']);
          $this->db->update('Modelo', $data);
        }

        public function listar(){
          $this->db->order_by('nombre', 'asc');
          return $this->db->get('Modelo')->result_array();
        }
    
}
?>
