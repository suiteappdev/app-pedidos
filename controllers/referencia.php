<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class referencia extends Controller {

    function __construct() {
        parent::__construct();
        header('content-type: application/json; charset=utf-8');
    }
    
    function index(){
        $output=null;

        $data['idproducto'] = $_GET['idproducto'];

        foreach ($this->model->obtenerReferencia($data) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $referencias = json_encode($output);
        
        echo isset($_GET['callback'])? "{$_GET['callback']}($referencias)" : $referencias;
    }

    public function crearReferencia(){
        $data['descripcion'] = $_POST['descripcion'];
        echo json_encode(array('id' => $this->model->crearPais($data)));
    }

    public function listaDeReferencias(){
        echo json_encode($this->model->listaDeReferencias());
    }

    public function borrarReferencia(){
        $data['id'] = $_POST['id'];
        $this->model->borrarReferencia($data);
    }

    public function actualizarReferencia(){
        $data['id'] = $_POST['id'];
        $data['descripcion'] = $_POST['descripcion'];
       echo json_encode($this->model->actualizarReferencia($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    }
}

