<?php
class Servicio extends CI_Model {

    public function __construct(){
            parent::__construct();
            $this->load->database();
    }
    
    public function crear($servicio){
        $this->db->insert('Servicios_orden', $servicio);
    }
    
    public function ver($codigo)
    { return $this->db->get_where('Servicios_orden',array('codigo'=>$codigo))->row_array(); }

    
    public function listar()
    { 
        $this->db->order_by('codigo', 'asc');
        return $this->db->get('Servicios_orden')->result_array();
    }
    
    public function eliminar($codigo)
    {
        $this->db->delete('Servicios_orden', array('codigo' => $codigo));
    }

    public function actualizar($servicio){
        $this->db->where('codigo',$servicio['codigo']);
        $this->db->update('Servicios_orden',$servicio);
    }
    
}
?>
