<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class tipoCliente extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDeTipoClientes());
    }

    public function crearTipoCliente(){
        $data['descripcion'] = $_POST['descripcion'];
        echo json_encode(array('id' => $this->model->crearTipoCliente($data)));
    }

    public function listaDeTipoClientes(){
        echo json_encode($this->model->listaDeTipoClientes());
    }

    public function borrarTipoCliente(){
        $data['id'] = $_POST['id'];
        $this->model->borrarTipoCliente($data);
    }

    public function actualizarTipoCliente(){
        $data['id'] = $_POST['id'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarTipoCliente($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}