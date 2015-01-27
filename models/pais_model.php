<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pais_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearPais($val){
    	return $this->db->insert('pais',
    		array('descripcion' => $val['descripcion'])
    		);
    }

    public function listaDePaises(){
    	return $this->db->select('SELECT * FROM pais');
    }

    public function borrarPais($data){
    	return $this->db->delete('pais', 'id ='.$data['id'], 1);
    }

    public function actualizarPais($data){
    	return $this->db->update('pais',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
    		);
    }

}