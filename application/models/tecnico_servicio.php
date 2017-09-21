<?php
class Tecnico_servicio extends CI_Model {

	private $tabla = 'TecnicoServicio';

    public function __construct(){
            parent::__construct();
            $this->load->database();
    }
    
    public function crear($valor){
        $this->db->insert('TecnicoServicio', $valor);
    }

    public function actualizarServicios($cedula,$valor) {
        $this->db->where('cedula_tecnico', $cedula);
        foreach ($valor as $s) {
            $datos = array(
                "servicio" => $s,
            );
            $this->db->update('TecnicoServicio', $datos);
        }
    }

    public function verServicios($cedula){
    	$this->db->select('servicio');
    	$this->db->where('cedula_tecnico',$cedula);
    	return $this->db->get($this->tabla)->result_array();
    }
    
}
?>
