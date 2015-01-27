<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class lineaPrecio extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDeLineaPrecios());
    }

    public function crearLineaPrecio(){
        $data['descripcion'] = $_POST['descripcion'];
        echo json_encode(array('id' => $this->model->crearLineaPrecio($data)));
    }

    public function listaLineaPrecios(){
        echo json_encode($this->model->listaDeLineaPrecios());
    }

    public function borrarLineaPrecio(){
        $data['id'] = $_POST['id'];
        $this->model->borrarLineaPrecio($data);
    }

    public function actualizarLineaPrecio(){
        $data['id'] = $_POST['id'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarLineaPrecio($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}