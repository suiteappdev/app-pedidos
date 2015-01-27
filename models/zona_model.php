<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Zona_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearZona($val){
    	return $this->db->insert('zonas',
    		array(
                'descripcion' => $val['descripcion']
                )
    		);
    }

    public function listaDeZonas(){
    	return $this->db->select('SELECT * FROM zonas');
    }

    public function borrarZona($data){
    	return $this->db->delete('zonas', 'id ='.$data['id'], 1);
    }

    public function actualizarZona($data){
    	return $this->db->update('zonas',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
    		);
    }

}