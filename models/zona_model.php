<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Zona_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearZona($val){
    	return $this->db->insert('zona',
    		array(
                'descripcion' => $val['descripcion']
                )
    		);
    }

    public function listaDeZona(){
    	return $this->db->select('SELECT * FROM zona');
    }

    public function borrarZona($data){
    	return $this->db->delete('zona', 'id ='.$data['id'], 1);
    }

    public function actualizarZona($data){
    	return $this->db->update('zona',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
    		);
    }

}