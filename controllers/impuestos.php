<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class impuestos extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDeImpuestos());
    }

    public function crearImpuestos(){
        $data['descripcion'] = $_POST['descripcion'];
        echo json_encode(array('id' => $this->model->crearImpuestos($data)));
    }

    public function listaDeImpuestos(){
        echo json_encode($this->model->listaDeImpuestos());
    }

    public function borrarImpuestos(){
        $data['id'] = $_POST['id'];
        $this->model->borrarImpuestos($data);
    }

    public function actualizarImpuestos(){
        $data['id'] = $_POST['id'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarImpuestos($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}