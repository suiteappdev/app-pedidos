<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class estadoCliente extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDeEstadoClientes());
    }

    public function crearEstadoCliente(){
        $data['descripcion'] = $_POST['descripcion'];
        echo json_encode(array('id' => $this->model->crearEstadoCliente($data)));
    }

    public function listaDeEstadoClientes(){
        echo json_encode($this->model->listaDeEstadoClientes());
    }

    public function borrarEstadoCliente(){
        $data['id'] = $_POST['id'];
        $this->model->borrarEstadoCliente($data);
    }

    public function actualizarEstadoCliente(){
        $data['id'] = $_POST['id'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarEstadoCliente($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}