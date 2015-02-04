<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class usuarioZona_Model extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function crearUsuarioZona($val){
        if($this->listaDeUsuarioZonas(' and zon.id ='.$val['idzona'].' and line.id = '.$val['idlinea'].' and clipre.identificacion = '.$val['identificacion'])){
            return json_encode(array('estado'=> 'existe'));
        }

    	return json_encode(array('id' => $this->db->insert('clientelineasdeprecio',
            array(
                'identificacion' => $val['identificacion'],
                'lineadeprecios' => $val['idlinea'],
                'zona' => $val['idzona']
                )
            )));
    }

    public function listaDeUsuarioZonas($filtro){
    	return $this->db->select('SELECT clipre.id, clipre.identificacion,  zon.id as idzona, line.id as idlinea, line.descripcion as lineaprecio, zon.descripcion as zona from clientelineadeprecio as clipre INNER JOIN lineadeprecio  as line INNER JOIN zona as zon WHERE line.id = clipre.lineadeprecios and zon.id = clipre.zona'.$filtro);
    }

    public function borrarUsuarioZona($data){
    	return $this->db->delete('clientelineadeprecio', 'id ='.$data['id'], 1);
    }

    public function actualizarUsuarioZona($data){
    	return $this->db->update('clientelineadeprecio',
            array(
                'identificacion' => $data['identificacion'],
                'zona' => $data['idzona'],
                'lineadeprecios' => $data['idlineaprecio']
                ), 'id ='.$data['id']
    		);
    }

}