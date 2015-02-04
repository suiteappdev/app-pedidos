<?php
class Cliente_Model extends Model{
	
	public function __construct(){
		parent::__construct();
	}

    public function ObtenerListaDeClientes(){
        return $this->db->select('SELECT * FROM cliente WHERE tipocliente = 1');
    }

    public function BusquedaClientes($data){
        return $this->db->select("SELECT  * FROM cliente WHERE tipocliente = 2 and LOWER(CONCAT(nombres, ' ', apellidos)) like '%$data%' limit 5");
    }
}