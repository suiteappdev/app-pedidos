<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class cliente extends Controller {

    function __construct() {
        parent::__construct();
        header('content-type: application/json; charset=utf-8');
    }
    
    function index(){
	   	
        $output=null;

        foreach ($this->model->ObtenerListaDeClientes() as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $clientList = json_encode($output);
        
	    echo isset($_GET['callback'])? "{$_GET['callback']}($clientList)" : $clientList;
    }

    function buscarCliente(){
        
        $output=null;
        $data = $_GET['criteria'];

        foreach ($this->model->BusquedaClientes($data) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $client = json_encode($output);
        
        echo isset($_GET['callback'])? "{$_GET['callback']}($client)" : $client;
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}