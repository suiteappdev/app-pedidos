<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class ciudad extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        if(isset($_POST['iddepartamento']) && !empty($_POST['iddepartamento'])){
            $data = 'and ci.iddepartamento ='.$_POST['iddepartamento'];   
        }else{
            $data = '';
        }

        echo json_encode($this->model->listaDeCiudades($data));
    }

    public function crearCiudad(){
        $data['descripcion'] = $_POST['descripcion'];
        $data['iddepartamento'] = $_POST['iddepartamento'];
        echo json_encode(array('id' => $this->model->crearCiudad($data)));
    }

    public function listaDeCiudades(){
        if(isset($_POST['iddepartamento']) && !empty($_POST['iddepartamento'])){
            $data = 'and ci.iddepartamento ='.$_POST['iddepartamento'];   
        }else{
            $data = '';
        }

        echo json_encode($this->model->listaDeDeCiudades($data));
    }

    public function borrarCiudad(){
        $data['id'] = $_POST['id'];
        $this->model->borrarCiudad($data);
    }

    public function actualizarCiudad(){
        $data['id'] = $_POST['id'];
        $data['iddepartamento'] = $_POST['iddepartamento'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarCiudad($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}