<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class zona extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDeZonas());
    }

    public function crearZona(){
        $data['descripcion'] = $_POST['descripcion'];
        echo json_encode(array('id' => $this->model->crearZona($data)));
    }

    public function listaDeZonas(){
        echo json_encode($this->model->listaDeZonas());
    }

    public function borrarZona(){
        $data['id'] = $_POST['id'];
        $this->model->borrarZona($data);
    }

    public function actualizarZona(){
        $data['id'] = $_POST['id'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarZona($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}