<?php
class Avenida extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct(){
                parent::__construct();
                $this->load->database();
        }

        public function dameUltimosDiezClientes()
        {
                // $this->db->select('Nombre','RIF','Direccion');
                $this->db->order_by('Nombre','ASC');
                $query = $this->db->get('Clientes', 10);
                return $query->result();
        }

        // Ver datos individuales

        public function verCliente($rif)
        {
                $query = $this->db->get_where('Clientes',array('RIF'=>$rif));
                return $query->result();
        }

         public function verModelo($id)
        {
            return $this->db->get_where('Modelo',array('id'=>$id))->row_array();
        }

        public function verModelosDeMarca($marca){
          return $this->db->get_where('Modelo',array('marca'=>$marca))->result_array(); 
        }

        public function verMarca($id)
        {
            return $this->db->get_where('Marca',array('id'=>$id))->row_array();
        }

        public function verTipoVehiculo($id)
        {
            return $this->db->get_where('TipoVehiculo',array('id'=>$id))->row_array();
        }

        public function verTiempoAtencion($servicio,$tipov)
        {
            return $this->db->get_where('TiempoAtencion',array('servicio'=>$servicio,'tipo_vehiculo'=>$tipov))->row_array();
        }

        // Registro de datos


        public function crearServicio(){
            $this->load->helper('url');
            $servicio = array(
                  'codigo' => $this->input->post('codigo'),
                  'nombre' => $this->input->post('nombre'),
                  'descripcion' => $this->input->post('descripcion')
            );
            return $this->db->insert('Servicios', $servicio);
        }

         public function registrarCliente()
        {
            $this->load->helper('url');
            $servicio = array(
                  'codigo' => $this->input->post('codigo'),
                  'nombres' => $this->input->post('nombres'),
                  'razon' => $this->input->post('razonS'),
                  'rif' => $this->input->post('rif'),
                  'direccion' => $this->input->post('direccion'),
                  'nit' => $this->input->post('nit'),
                  'documentoF' => $this->input->post('df'),
                  'telefono' => $this->input->post('tlf'),
                  'estado' => $this->input->post('estado'),
                  'ciudad' => $this->input->post('ciudad'),
                  'municipio' => $this->input->post('mcpio'),
            );
            return $this->db->insert('Servicios', $servicio);
        }

        public function crearTipoVehiculo($descripcion){
             $data = array(
            'descripcion' => $descripcion,
          );

            $this->db->insert('TipoVehiculo', $data);
        }

        public function crearMarca($nombre){
          $data = array(
            'nombre' => $nombre
          );

          $this->db->insert('Marca', $data);
        }

        public function crearModelo($nombre,$marca){
          $data = array(
            'nombre' => $nombre,
            'marca' => $marca,
          );

          $this->db->insert('Modelo', $data);
        }

        public function crearTiempoAtencion($fila){
            $this->db->insert('TiempoAtencion', $fila);
        }

        public function crearVehiculo($carro){
          $data = array(
            'placa' => $carro['placa'],
            'modelo' => $carro['modelo'],
            'marca' => $carro['marca'],
            'tipo_vehiculo' => $carro['tipo_vehiculo'],
            'cliente' => $carro['cliente'],
          );

          $this->db->insert('Modelo', $data);
        }

        // Borrado de datos

        public function eliminarMarca($id){
          $this->db->delete('Marca', array('id' => $id));
        }

        public function eliminarModelo($id){
          $this->db->delete('Modelo', array('id' => $id));
        }

        public function eliminarTipoVehiculo($id){
          $this->db->delete('TipoVehiculo', array('id' => $id));
        }

        public function eliminarTiempoAtencion($serv,$tipov){
          $this->db->delete('TiempoAtencion', array('servicio' => $serv,'tipo_vehiculo'=>$tipov));
        }

        public function eliminarVehiculo($placa){
          $this->db->delete('Vehiculo', array('placa' => $placa));
        }

        // Actualizar tablas

         public function actualizarCliente()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update('Clientes', $this, array('id' => $_POST['id']));
        }

        public function actualizarMarca($id,$nombre){
          $data = array(
            'nombre' => $nombre
          );

          $this->db->where('id', $id);
          $this->db->update('Marca', $data);
        }

        public function actualizarModelo($id,$nombre){
           $data = array(
            'nombre' => $nombre
          );

          $this->db->where('id', $id);
          $this->db->update('Modelo', $data);
        }

        public function actualizarTipoVehiculo($id,$nombre){
           $data = array(
            'descripcion' => $nombre
          );

          $this->db->where('id', $id);
          $this->db->update('TipoVehiculo', $data);
        }

        public function actualizarVehiculo($carro){
           $data = array(
            'placa' => $carro['placa'],
            'modelo' => $carro['modelo'],
            'marca' => $carro['marca'],
            'tipo_vehiculo' => $carro['tipo_vehiculo'],
            'cliente' => $carro['cliente'],
          );

          $this->db->where('placa', $carro['placa']);
          $this->db->update('Vehiculo', $data);
        }

        // Lista de tablas

        public function listarServicios()
        {
          $this->db->order_by('codigo', 'desc');
          return $this->db->get('Servicios')->result_array();
        }

        public function listarMarcas(){
          $this->db->order_by('id', 'desc');
          return $this->db->get('Marca')->result_array();
        }

        public function listarModelos(){
          $this->db->order_by('id', 'desc');
          return $this->db->get('Modelo')->result_array();
        }

        public function listarTiposVehiculos(){
          $this->db->order_by('id', 'desc');
          return $this->db->get('TipoVehiculo')->result_array();
        }

        public function listarTiemposAtencion(){
          $this->db->order_by('tiempo', 'asc');
          return $this->db->get('TiempoAtencion')->result_array();
        }

        public function listarVehiculos(){
          $this->db->order_by('Vehiculo', 'asc');
          return $this->db->get('Vehiculo')->result_array();
        }

}
?>