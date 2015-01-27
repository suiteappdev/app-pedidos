<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class familia1_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearFamilia1($val){
        if(isset($val['image'])){
            return $this->db->insert('familia1',
                array(
                    'urlimg' => $val['image'],
                    'estado'=> $val['estado'],
                    'descripcion' => $val['descripcion']
                    )
                );            
        }

        return $this->db->insert('familia1',
            array(
                'estado'=> $val['estado'],
                'descripcion' => $val['descripcion']
                )
            ); 
    }

    public function listaDeFamilia1(){
    	return $this->db->select('SELECT f1.id, f1.urlimg, f1.descripcion, cat.id as idestado, cat.descripcion as descripcionestado  FROM familia1 as f1 INNER JOIN estadocategoria as cat WHERE f1.estado = cat.id');
    }

    public function borrarFamilia1($data){
        try {
            $this->db->delete('familia1', 'id ='.$data['id'], 1);
            echo json_encode(array(
                'success' => 'se ha eliminado correctamente'
                ));
        } catch (Exception $e) {
          echo json_encode(array(
                'error' => 'existe una relacion con otra subfamilia'
            ));
        }
    }

    public function actualizarFamilia1($data){
        if(isset($data['image'])){
            return $this->db->update('familia1',
                array(
                    'urlimg' => $data['image'],
                    'estado'=> $data['estado'],
                    'descripcion' => $data['descripcion']
                    ), 'id='.$data['id']
                );            
        }

        return $this->db->update('familia1',
            array(
                'estado'=> $data['estado'],
                'descripcion' => $data['descripcion']
                ), 'id='.$data['id'] 
            ); 
    }

}