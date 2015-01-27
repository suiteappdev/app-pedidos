<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class pais extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDePaises());
    }

    public function crearPais(){
        $data['descripcion'] = $_POST['descripcion'];
        echo json_encode(array('id' => $this->model->crearPais($data)));
    }

    public function listaDePaises(){
        echo json_encode($this->model->listaDePaises());
    }

    public function borrarPais(){
        $data['id'] = $_POST['id'];
        $this->model->borrarPais($data);
    }

    public function actualizarPais(){
        $data['id'] = $_POST['id'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarPais($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}