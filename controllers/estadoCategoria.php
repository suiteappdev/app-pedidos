<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class estadoCategoria extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDeEstadoCategorias());
    }

    public function crearEstadoCategoria(){
        $data['descripcion'] = $_POST['descripcion'];
        echo json_encode(array('id' => $this->model->crearEstadoCategoria($data)));
    }

    public function listaDeEstadoCategorias(){
        echo json_encode($this->model->listaDeEstadoCategorias());
    }

    public function borrarEstadoCategoria(){
        $data['id'] = $_POST['id'];
        $this->model->borrarEstadoCategoria($data);
    }

    public function actualizarEstadoCategoria(){
        $data['id'] = $_POST['id'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarEstadoCategoria($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}