<?php
class Referencia_Model extends Model{
	
	public function __construct(){
		parent::__construct();
	}

    public function obtenerReferencia($data){
        return $this->db->select('SELECT ref.referencia FROM referenciaalterna as ref inner join producto as pro WHERE ref.idproducto = pro.id and ref.idproducto = :idproducto',
         array(
                ':idproducto' => $data['idproducto']
                )
            );  
    }

    public function crearReferencia($val){
        return $this->db->insert('pais',
            array('descripcion' => $val['descripcion'])
            );
    }

    public function listaDeReferencias(){
        return $this->db->select('SELECT * FROM referenciaalterna');
    }

    public function borrarReferencia($data){
        return $this->db->delete('referenciaalterna', 'id ='.$data['id'], 1);
    }

    public function actualizarReferencia($data){
        return $this->db->update('referenciaalterna',
            array(
                'descripcion' => $data['descripcion']
                ), 'id ='.$data['id']
            );
    }


}