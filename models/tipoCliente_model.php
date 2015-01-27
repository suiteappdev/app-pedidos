<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class tipoCliente_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearTipoCliente($val){
    	return $this->db->insert('tipocliente',
    		array(
                'descripcion' => $val['descripcion']
                )
    		);
    }

    public function listaDeTipoClientes(){
    	return $this->db->select('SELECT * FROM tipocliente');
    }

    public function borrarTipoCliente($data){
    	return $this->db->delete('tipocliente', 'id ='.$data['id'], 1);
    }

    public function actualizarTipoCliente($data){
    	return $this->db->update('tipocliente',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
    		);
    }

}