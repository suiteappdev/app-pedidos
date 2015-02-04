<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class estadoCliente_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearEStadoCliente($val){
    	return $this->db->insert('estadocliente',
    		array(
                'descripcion' => $val['descripcion']
                )
    		);
    }

    public function listaDeEstadoClientes(){
    	return $this->db->select('SELECT * FROM estadocliente');
    }

    public function borrarEstadoCliente($data){
    	return $this->db->delete('estadocliente', 'id ='.$data['id'], 1);
    }

    public function actualizarEstadoCliente($data){
    	return $this->db->update('estadocliente',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
    		);
    }

}