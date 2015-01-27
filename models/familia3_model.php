<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class familia3_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearFamilia3($val){
        if(isset($val['image'])){
            return $this->db->insert('familia3',
            array(
                'descripcion' => $val['descripcion'],
                'urlimg' => $val['image'],
                'familia' => $val['familia'],
                'estado' => $val['estado']
                )
            );
        }
        
    	return $this->db->insert('familia3',
    		array(
                'descripcion' => $val['descripcion'],
                'familia' => $val['familia'],
                'estado' => $val['estado']
                )
    		);
    }

    public function listaDeFamilia3($data){
        if(isset($data['idfamilia'])){
            return $this->db->select('SELECT f3.id, f3.descripcion FROM familia3 as f3 INNER JOIN familia2 as f2 INNER JOIN estadocategoria as cat WHERE f3.familia = f2.id and f3.estado = cat.id and f2.id = :idfamilia', array(
                    ':idfamilia'=> $data['idfamilia']
                ));
        }

    	return $this->db->select('SELECT f3.id, f3.urlimg, f3.familia as idfamilia, f3.estado as idestado, f3.descripcion,  cat.descripcion as descripcionestado, f2.descripcion as familia FROM familia3 as f3 INNER JOIN familia2 as f2 INNER JOIN estadocategoria as cat WHERE f3.familia = f2.id and f3.estado = cat.id ');
    }

    public function borrarFamilia3($data){
        try {
            $this->db->delete('familia3', 'id ='.$data['id'], 1);
            echo json_encode(array(
                'success' => 'se ha eliminado correctamente'
                ));
        } catch (Exception $e) {
           echo json_encode(array(
                'error' => 'existe una relacion con otra subcategoria'
            )); 
        }
    }

    public function actualizarFamilia3($data){
        if(isset($data['image'])){
            return $this->db->update('familia3',
                array(
                    'urlimg' => $data['image'],
                    'estado'=> $data['estado'],
                    'familia' => $data['familia'],
                    'descripcion' => $data['descripcion']
                    ), 'id ='.$data['id']
                );            
        }

        return $this->db->update('familia3',
            array(
                'estado'=> $data['estado'],
                'familia' => $data['familia'],
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
            );  
    }

}