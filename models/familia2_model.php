<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class familia2_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearFamilia2($val){
        if(isset($val['image'])){
            return $this->db->insert('familia2',
            array(
                'descripcion' => $val['descripcion'],
                'urlimg' => $val['image'],
                'familia' => $val['familia'],
                'estado' => $val['estado']
                )
            );
        }
        
    	return $this->db->insert('familia2',
    		array(
                'descripcion' => $val['descripcion'],
                'familia' => $val['familia'],
                'estado' => $val['estado']
                )
    		);
    }

    public function listaDeFamilia2($data){
        if(isset($data['idfamilia'])){
            return $this->db->select('SELECT f2.id, f2.descripcion  FROM  familia2 as f2 INNER JOIN familia1 as f1 INNER JOIN estadocategoria as est WHERE f2.familia = f1.id and f2.estado = est.id and f1.id = :idfamilia', array(
                    ':idfamilia' => $data['idfamilia']
                ));
        }
        
    	return $this->db->select('SELECT f2.id, f2.urlimg, f2.familia as idfamilia, est.id as idestado, f2.descripcion, est.descripcion as descripcionestado, f1.descripcion as familia FROM  familia2 as f2 INNER JOIN familia1 as f1 INNER JOIN estadocategoria as est WHERE f2.familia = f1.id and f2.estado = est.id');
    }

    public function borrarFamilia2($data){
        try {
            $this->db->delete('familia2', 'id ='.$data['id'], 1);
            echo json_encode(array(
                'success' => 'se ha eliminado correctamente'
                ));
        } catch (Exception $e) {
            echo json_encode(array(
                    'error' => 'existe una relacion con otra subfamilia'
                ));
        }
    }

    public function actualizarFamilia2($data){
        if(isset($data['image'])){
            return $this->db->update('familia2',
                array(
                    'urlimg' => $data['image'],
                    'estado'=> $data['estado'],
                    'familia' => $data['familia'],
                    'descripcion' => $data['descripcion']
                    ), 'id ='.$data['id']
                );            
        }

        return $this->db->update('familia2',
            array(
                'estado'=> $data['estado'],
                'familia' => $data['familia'],
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
            );  
    }

}