<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class tipoIdentificacion extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDeTipoIdentificaciones());
    }

    public function crearTipoIdentificacion(){
        $data['descripcion'] = $_POST['descripcion'];
        echo json_encode(array('id' => $this->model->crearTipoIdentificacion($data)));
    }

    public function listaDeTipoIdentificacion(){
        echo json_encode($this->model->listaDeTipoIdentificaciones());
    }

    public function borrarTipoIdentificacion(){
        $data['id'] = $_POST['id'];
        $this->model->borrarTipoIdentificacion($data);
    }

    public function actualizarTipoIdentificacion(){
        $data['id'] = $_POST['id'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarTipoIdentificacion($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}