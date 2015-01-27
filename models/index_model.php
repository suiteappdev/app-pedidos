<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Index_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function ObtenerEmpresa($data){
        return $this->db->select('SELECT dbo.EmpresasAPL.IdEmpresaAPL, dbo.Ciudades.IdCiudad, dbo.EmpresasAPL.Empresa, dbo.Ciudades.Ciudad FROM dbo.EmpresasAPL INNER JOIN dbo.Ciudades ON dbo.EmpresasAPL.IdCiudad = dbo.Ciudades.IdCiudad WHERE dbo.EmpresasAPL.IdEmpresaAPL = :empresa', array(
            ':empresa' => $data 
            ));
    }

}