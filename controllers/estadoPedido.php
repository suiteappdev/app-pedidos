<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class estadoPedido extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDeEstadoPedidos());
    }

    public function crearEstadoPedido(){
        $data['descripcion'] = $_POST['descripcion'];
        echo json_encode(array('id' => $this->model->crearEstadoPedido($data)));
    }

    public function listaDeEstadoPedidos(){
        echo json_encode($this->model->listaDeEstadoPedidos());
    }

    public function borrarEstadoPedido(){
        $data['id'] = $_POST['id'];
        $this->model->borrarEstadoPedido($data);
    }

    public function actualizarEstadoPedido(){
        $data['id'] = $_POST['id'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarEstadoPedido($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}