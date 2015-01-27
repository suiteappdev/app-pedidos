<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class estadoPedido_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearEstadoPedido($val){
    	return $this->db->insert('estadospedidos',
    		array('descripcion' => $val['descripcion'])
    		);
    }

    public function listaDeEstadoPedidos(){
    	return $this->db->select('SELECT * FROM estadospedidos');
    }

    public function borrarEstadoPedido($data){
    	return $this->db->delete('estadospedidos', 'id ='.$data['id'], 1);
    }

    public function actualizarEstadoPedido($data){
    	return $this->db->update('estadospedidos',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
    		);
    }

}