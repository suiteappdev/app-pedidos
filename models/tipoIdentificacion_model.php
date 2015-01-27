<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class tipoidentificacion_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearTipoIdentificacion($val){
    	return $this->db->insert('tipoidentificacion',
    		array(
                'descripcion' => $val['descripcion']
                )
    		);
    }

    public function listaDeTipoIdentificaciones(){
    	return $this->db->select('SELECT * FROM tipoidentificacion');
    }

    public function borrarTipoIdentificacion($data){
    	return $this->db->delete('tipoidentificacion', 'id ='.$data['id'], 1);
    }

    public function actualizarTipoIdentificacion($data){
    	return $this->db->update('tipoidentificacion',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
    		);
    }

}