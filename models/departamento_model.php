<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Departamento_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearDepartamento($val){
    	return $this->db->insert('departamento',
    		array(
                'descripcion' => $val['descripcion'],
                'idpais' => $val['id'],
                )
    		);
    }

    public function listaDeDepartamentos(){
    	return $this->db->select('SELECT dp.descripcion, dp.id, ps.descripcion as pais, ps.id as idpais FROM departamento as dp INNER JOIN pais as ps WHERE dp.idpais = ps.id');
    }

    public function borrarDepartamento($data){
    	return $this->db->delete('departamento', 'id ='.$data['id'], 1);
    }

    public function actualizarDepartamento($data){
    	return $this->db->update('departamento',
            array(
                'descripcion' => $data['descripcion'],
                'idpais' => $data['idpais']
                ), 'id ='.$data['id']
    		);
    }

}