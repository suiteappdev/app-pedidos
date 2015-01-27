<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class familia4_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearFamilia4($val){
        if(isset($val['image'])){
            return $this->db->insert('familia4',
            array(
                'descripcion' => $val['descripcion'],
                'urlimg' => $val['image'],
                'familia' => $val['familia'],
                'estado' => $val['estado']
                )
            );
        }
        
    	return $this->db->insert('familia4',
    		array(
                'descripcion' => $val['descripcion'],
                'familia' => $val['familia'],
                'estado' => $val['estado']
                )
    		);
    }

    public function listaDeFamilia4($data){
        if(isset($data)){
            return $this->db->select('SELECT f4.id, f4.descripcion FROM familia4 as f4 INNER JOIN familia3 as f3 INNER JOIN estadocategoria as cat WHERE f4.familia = f3.id and f4.estado = cat.id and f3.id = :idfamilia', array(
                    ':idfamilia' =>$data['idfamilia']
                ));
        }
        
    	return $this->db->select('SELECT f4.id, f4.urlimg, f4.familia as idfamilia, f4.estado as idestado, f4.descripcion,  cat.descripcion as descripcionestado, f3.descripcion as familia FROM familia4 as f4 INNER JOIN familia3 as f3 INNER JOIN estadocategoria as cat WHERE f4.familia = f3.id and f4.estado = cat.id');
    }

    public function borrarFamilia4($data){
        try {
            $this->db->delete('familia4', 'id ='.$data['id'], 1);
            echo json_encode(array(
                'success' => 'se ha eliminado correctamente'
                ));
        } catch (Exception $e) {
            echo json_encode(array(
                    'error'=>'existe una relacion con otra subfamilia'
                ));
        }
    }

    public function actualizarFamilia4($data){
        if(isset($data['image'])){
            return $this->db->update('familia4',
                array(
                    'urlimg' => $data['image'],
                    'estado'=> $data['estado'],
                    'familia' => $data['familia'],
                    'descripcion' => $data['descripcion']
                    ), 'id ='.$data['id']
                );            
        }

        return $this->db->update('familia4',
            array(
                'estado'=> $data['estado'],
                'familia' => $data['familia'],
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
            );  
    }

}