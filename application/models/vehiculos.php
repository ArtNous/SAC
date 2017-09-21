<?php
class Vehiculos extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct(){
                parent::__construct();
                $this->load->database();
        }


        public function crear($carro){
          $data = array(
            'placa' => $carro['placa'],
            'modelo' => $carro['modelo'],
            'marca' => $carro['marca'],
            'tipo_vehiculo' => $carro['tipov'],
          );

          $this->db->insert('Vehiculo', $data);
        }

        public function eliminar($placa){
          $this->db->delete('Vehiculo', array('placa' => $placa));
        }

        public function actualizar($carro){
          $this->db->where('placa', $carro['placa']);
          $this->db->update('Vehiculo', $carro);
        }

        public function listar(){
          $this->db->order_by('placa', 'asc');
          return $this->db->get('Vehiculo')->result_array();
        }
    
        public function buscarVehiculosDeCliente($rif){
            return $this->db->get_where('Vehiculo',array('cliente'=>$rif))->result_array();   
        }

        public function verVehiculoPlaca($placa){
          $this->db->select('Vehiculo.placa as placa, Marca.nombre as marca, Modelo.nombre as modelo, TipoVehiculo.descripcion as tipo_vehiculo');
          $this->db->from('Vehiculo');
          $this->db->join('Marca','Vehiculo.marca = Marca.id','inner');
          $this->db->join('Modelo','Vehiculo.modelo = Modelo.id','inner');
          $this->db->join('TipoVehiculo','Vehiculo.tipo_vehiculo = TipoVehiculo.id','inner');
          $this->db->where('Vehiculo.placa',$placa);
          $query = $this->db->get();
          if($query->num_rows() != 0)
          {
              return $query->row_array();
          }
          else
          {
              return false;
          }
        }

        public function ver($placa) {
          $this->db->where('placa',$placa);
          $query = $this->db->get('Vehiculo');
          if($query->num_rows() != 0)
          {
              return $query->row_array();
          }
          else
          {
              return false;
          }
        }

        public function modificarKilometraje($placa,$km){
          $data = array(
            "km_actual" => $km,  
          );
          $this->db->where('placa',$placa);
          $this->db->update('Vehiculo',$data);
        }

        public function dameSimilares($valor){
          $sql = "SELECT TOP 20 placa
          FROM Vehiculo
          WHERE placa LIKE '%".$valor."%'";
          return $this->db->query($sql)->result_array();
        }

}
?>
