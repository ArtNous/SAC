<?php
class Clientes extends CI_Model {

	private $tabla = 'Clientes';

	public function __construct(){
		parent::__construct();
		$this->load->database();
		
	}
    
	public function dameLote($pos,$cantidad){
		$sql = "SELECT * FROM Clientes ORDER BY CodigoCliente OFFSET ".intval($pos)." ROWS FETCH NEXT ".intval($cantidad)." ROWS ONLY";
		return $this->db->query($sql)->result_array();
	}

	public function dameSimilares($valor){
		$sql = "SELECT TOP 20 CodigoCliente
			  FROM Clientes
			  WHERE CodigoCliente LIKE '%".$valor."%'";
		return $this->db->query($sql)->result_array();
	}

	public function dameNombresSimilares($valor){
		$sql = "SELECT TOP 20 Nombre
			  FROM Clientes
			  WHERE Nombre LIKE '%".$valor."%'";
		return $this->db->query($sql)->result_array();
	}

	// Ver datos individuales

	public function ver($rif)
	{
	   return $this->db->get_where('Clientes',array('CodigoCliente'=>$rif))->row_array();
	}
	
	public function verPorNombre($nombre)
	{
	   return $this->db->get_where('Clientes',array('Nombre'=>$nombre))->row_array();
	}
      
	 public function crear($cliente)
	{
	    $this->db->insert('Clientes', $cliente);
	}

	public function eliminar($rif){
		$this->db->delete('Clientes',array('RIF'=>$rif));
		return true;
	}

	 public function actualizar($cliente)
	{
	  $this->db->where('RIF',$cliente['RIF']);
	  $this->db->update('Clientes', $cliente);
	}
    
	public function listar(){
	    $this->db->order_by('RIF', 'asc');
	    return $this->db->get('Clientes')->result_array();
	}

	public function verEstados(){
		$bdBase = $this->load->database('base',true);
		$bdBase->order_by('Nombre', 'asc');
	    return $bdBase->get('Estados')->result_array();
	}

	public function verMunicipios(){
		$bdBase = $this->load->database('base',true);
		$bdBase->order_by('Nombre', 'asc');
	    return $bdBase->get('Municipios')->result_array();
	}

	public function verCiudades(){
		$bdBase = $this->load->database('base',true);
		$bdBase->order_by('Nombre', 'asc');
	    return $bdBase->get('Ciudades')->result_array();
	}

	public function verGrupos(){
		$this->db->order_by('Nombre', 'asc');
	    return $this->db->get('ClientesGrupos')->result_array();
	}

	public function verZonas(){
		$this->db->order_by('Nombre', 'asc');
	    return $this->db->get('Zonas')->result_array();
	}

}
?>
