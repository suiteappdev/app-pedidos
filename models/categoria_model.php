<?php
/**
* 
*/
class Categoria_Model extends Model{
	
	public function __construct(){
		parent::__construct();
	}


    public function familia1(){
        return $this->db->select('SELECT * FROM familia1');
    }

    public function familia2($id){
    	return $this->db->select('SELECT * FROM familia2 WHERE familia = :familia',
    		array(
          ':familia' => $id['familia']
          )
    		);
    }

    public function familia3($id){
        return $this->db->select('SELECT * FROM familia3 WHERE familia = :val',
            array(
              ':val' => $id['familia']
                  )
            );
    }

    public function familia4($id){
        return $this->db->select('SELECT * FROM familia4 WHERE familia = :familia',
            array(
              ':familia' => $id['familia']
              )
            );
    }
    
    public function familia5($id){
        return $this->db->select('SELECT * FROM familia5 WHERE familia = :familia',
            array(
              ':familia' => $id['familia']
                  )
            );
    }
}