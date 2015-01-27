<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function xhrInsert() 
    {
        $text = $_POST['text'];
        
        $this->db->insert('data', array('text' => $text));
        
        $data = array('text' => $text, 'id' => $this->db->lastInsertId());
        echo json_encode($data);
    }
    
    public function xhrGetListings()
    {
        $result = $this->db->select("SELECT * FROM data");
        echo json_encode($result);
    }
    
    public function xhrDeleteListing()
    {
        $id = (int) $_POST['id'];
        $this->db->delete('data', "id = '$id'");
    }

    public function ObtenerEmpresa($data){
        return $this->db->select('SELECT dbo.EmpresasAPL.IdEmpresaAPL, dbo.Ciudades.IdCiudad, dbo.EmpresasAPL.Empresa, dbo.Ciudades.Ciudad FROM dbo.EmpresasAPL INNER JOIN dbo.Ciudades ON dbo.EmpresasAPL.IdCiudad = dbo.Ciudades.IdCiudad WHERE dbo.EmpresasAPL.IdEmpresaAPL = :empresa', array(
            ':empresa' => $data 
            ));
    }

}