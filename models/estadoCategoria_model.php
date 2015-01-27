<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class EstadoCategoria_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function crearEstadoCategoria($val){
        return $this->db->insert('estadocategoria',
            array(
                'descripcion' => $val['descripcion']
                )
            );
    }

    public function listaDeEstadoCategorias(){
        return $this->db->select('SELECT * FROM estadocategoria');
    }

    public function borrarEstadoCategoria($data){
        return $this->db->delete('estadocategoria', 'id ='.$data['id'], 1);
    }

    public function actualizarEstadoCategoria($data){
        return $this->db->update('estadocategoria',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
            );
    }

}