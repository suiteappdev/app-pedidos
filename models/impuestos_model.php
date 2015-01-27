<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class impuestos_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearImpuestos($val){
    	return $this->db->insert('impuesto',
    		array(
                'descripcion' => $val['descripcion']
                )
    		);
    }

    public function listaDeImpuestos(){
    	return $this->db->select('SELECT * FROM impuesto order by impuesto.descripcion asc');
    }

    public function borrarImpuestos($data){
    	return $this->db->delete('impuesto', 'id ='.$data['id'], 1);
    }

    public function actualizarImpuestos($data){
    	return $this->db->update('impuesto',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
    		);
    }

}