<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class lineaPrecio_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearLineaPrecio($val){
    	$linea =  $this->db->insert('lineasdeprecio',
    		array('descripcion' => $val['descripcion'])
    		);

        $productos = $this->db->select('SELECT * FROM productos');
        
        if($productos){
            foreach ($productos as $value) {
                $this->db->insert('preciosalternos', array(
                    'idpro' => $value['id'],
                    'lineadeprecio' => $linea
                    ));
            }
        }

        return $linea;
    }

    public function listaDeLineaPrecios(){
    	return $this->db->select('SELECT * FROM lineasdeprecio');

    }

    public function borrarLineaPrecio($data){
    	return $this->db->delete('lineasdeprecio', 'id ='.$data['id'], 1);
    }

    public function actualizarLineaPrecio($data){
    	return $this->db->update('lineasdeprecio',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
    		);
    }

}