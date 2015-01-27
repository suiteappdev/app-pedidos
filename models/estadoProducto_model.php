<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class estadoProducto_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearEstadoProducto($val){
    	return $this->db->insert('estadoproductos',
    		array('descripcion' => $val['descripcion'])
    		);
    }

    public function listaDeEstadoProductos(){
    	return $this->db->select('SELECT * FROM estadoproductos');
    }

    public function borrarEstadoProducto($data){
    	return $this->db->delete('estadoproductos', 'id ='.$data['id'], 1);
    }

    public function actualizarEstadoProducto($data){
    	return $this->db->update('estadoproductos',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
    		);
    }

}