<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ubicacion_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearUbicacion($val){
    	return $this->db->insert('zonasalternas',
    		array(
                'iddepartamento' => $val['iddepartamento'],
                'idzona' => $val['idzona']
                )
    		);
    }

    public function listaDeUbicaciones($condition){
        return $this->db->select('SELECT dep.descripcion, zalt.id FROM zonasalternas as zalt INNER JOIN zonas as zon INNER JOIN departamento as dep WHERE zon.id = zalt.idzona and zalt.iddepartamento = dep.id '.$condition);
    }

    public function borrarUbicacion($data){
    	return $this->db->delete('zonasalternas', 'id ='.$data['id'], 1);
    }

    public function actualizarUbicacion($data){
    	return $this->db->update('zonasalternas',
            array(
                'idzona' => $data['idzona'],
                'iddepartamento' => $data['iddepartamento']
                ), 'id ='.$data['id']
    		);
    }

}