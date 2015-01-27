<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class estadoProducto extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDeEstadoProductos());
    }

    public function crearEstadoProducto(){
        $data['descripcion'] = $_POST['descripcion'];
        echo json_encode(array('id' => $this->model->crearEstadoProducto($data)));
    }

    public function listaDeEstadoProductos(){
        echo json_encode($this->model->listaDeEstadoProductos());
    }

    public function borrarEstadoProducto(){
        $data['id'] = $_POST['id'];
        $this->model->borrarEstadoProducto($data);
    }

    public function actualizarEstadoProducto(){
        $data['id'] = $_POST['id'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarEstadoProducto($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}