<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class departamento extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDeDepartamentos());
    }

    public function crearDepartamento(){
        $data['descripcion'] = $_POST['descripcion'];
        $data['id'] = $_POST['id'];
        echo json_encode(array('id' => $this->model->crearDepartamento($data)));
    }

    public function listaDeDepartamentos(){
        echo json_encode($this->model->listaDeDepartamentos());
    }

    public function borrarDepartamento(){
        $data['id'] = $_POST['id'];
        $this->model->borrarDepartamento($data);
    }

    public function actualizarDepartamento(){
        $data['id'] = $_POST['id'];
        $data['idpais'] = $_POST['idpais'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarDepartamento($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}