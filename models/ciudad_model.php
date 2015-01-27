<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ciudad_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearCiudad($val){
    	return $this->db->insert('ciudad',
    		array(
                'descripcion' => $val['descripcion'],
                'iddepartamento' => $val['iddepartamento'],
                )
    		);
    }

    public function listaDeCiudades($filtro){
    	return $this->db->select('SELECT ci.id, ci.descripcion, dp.descripcion as departamento, dp.id as iddepartamento FROM ciudad as ci INNER JOIN departamento as dp WHERE ci.iddepartamento = dp.id '.$filtro);
    }

    public function borrarCiudad($data){
    	return $this->db->delete('ciudad', 'id ='.$data['id'], 1);
    }

    public function actualizarCiudad($data){
    	return $this->db->update('ciudad',
            array(
                'descripcion' => $data['descripcion'],
                'iddepartamento' => $data['iddepartamento']
                ), 'id ='.$data['id']
    		);
    }

}