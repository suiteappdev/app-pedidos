<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Categoria extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function familia1() {
	   header('content-type: application/json; charset=utf-8');
        $output=null;

        foreach ($this->model->familia1() as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $categorias= json_encode($output);
        
	    echo isset($_GET['callback'])? "{$_GET['callback']}($categorias)" : $categorias;

    }

    function familia2(){
        header('content-type: application/json; charset=utf-8');
        
        $output=null;
        $data = $_GET['familia'];

        foreach ($this->model->familia2($data) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $categoriasHijas = json_encode($output);
        
        echo isset($_GET['callback'])? "{$_GET['callback']}($categoriasHijas)" : $categoriasHijas; 
    }

    function familia3(){
        header('content-type: application/json; charset=utf-8');
        $output=null;

        $data = $_GET['familia'];
        
        foreach ($this->model->familia3($data) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $categoriasHijas = json_encode($output);
        
        echo isset($_GET['callback'])? "{$_GET['callback']}($categoriasHijas)" : $categoriasHijas; 
    }

    function familia4(){
        header('content-type: application/json; charset=utf-8');
        
        $output=null;
        $data = $_GET['familia'];

        foreach ($this->model->familia4($data) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $categoriasHijas = json_encode($output);
        
        echo isset($_GET['callback'])? "{$_GET['callback']}($categoriasHijas)" : $categoriasHijas; 
    }

    function familia5(){
        header('content-type: application/json; charset=utf-8');
        
        $output=null;
        $data = $_GET['familia'];

        foreach ($this->model->familia5($data) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $categoriasHijas = json_encode($output);
        
        echo isset($_GET['callback'])? "{$_GET['callback']}($categoriasHijas)" : $categoriasHijas; 
    }
   
}