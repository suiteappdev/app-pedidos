<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class familia5_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearFamilia5($val){
        if(isset($val['image'])){
            return $this->db->insert('familia5',
            array(
                'descripcion' => $val['descripcion'],
                'urlimg' => $val['image'],
                'familia' => $val['familia'],
                'estado' => $val['estado']
                )
            );
        }
        
    	return $this->db->insert('familia5',
    		array(
                'descripcion' => $val['descripcion'],
                'familia' => $val['familia'],
                'estado' => $val['estado']
                )
    		);
    }

    public function listaDeFamilia5($data){
        if(isset($data)){
            return $this->db->select('SELECT f5.id, f5.descripcion FROM familia5 as f5 INNER JOIN familia4 as f4 INNER JOIN estadocategoria as cat WHERE f5.familia = f4.id and f5.estado = cat.id and f4.id = :idfamilia', array(
                    ':idfamilia' => $data['idfamilia']
                ));
        }

    	return $this->db->select('SELECT f5.id, f5.urlimg, f5.familia as idfamilia, f5.estado as idestado, f5.descripcion,  cat.descripcion as descripcionestado, f4.descripcion as familia FROM familia5 as f5 INNER JOIN familia4 as f4 INNER JOIN estadocategoria as cat WHERE f5.familia = f4.id and f5.estado = cat.id');
    }

    public function borrarFamilia5($data){
        try{
            $this->db->delete('familia5', 'id ='.$data['id'], 1);
            echo json_encode(array(
                'success' => 'se ha eliminado correctamente'
                ));
        }catch(Exception $e){
            echo json_encode(array(
                'error'=>'existe una relacion con otra subfamilia'
                ));
        }
    }

    public function actualizarFamilia5($data){
        if(isset($data['image'])){
            return $this->db->update('familia5',
                array(
                    'urlimg' => $data['image'],
                    'estado'=> $data['estado'],
                    'familia' => $data['familia'],
                    'descripcion' => $data['descripcion']
                    ), 'id ='.$data['id']
                );            
        }

        return $this->db->update('familia5',
            array(
                'estado'=> $data['estado'],
                'familia' => $data['familia'],
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
            );  
    }

}