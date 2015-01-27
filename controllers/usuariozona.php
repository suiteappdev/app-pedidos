<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class UsuarioZona extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        if(isset($_POST['identificacion'])){
            $data = ' and clipre.identificacion ='.$_POST['identificacion'];
        }else{
            $data = '';
        }

        echo json_encode($this->model->listaDeUsuarioZonas($data));
    }

    public function crearUsuarioZona(){
        $data['idzona'] = $_POST['idzona'];
        $data['identificacion'] = $_POST['identificacion'];
        $data['idlinea'] = $_POST['idlinea'];
        echo $this->model->crearUsuarioZona($data);
    }

    public function listaDeUsuarioZonas(){
        echo json_encode($this->model->listaDeUsuarioZonas());
    }

    public function borrarUsuarioZona(){
        $data['id'] = $_POST['id'];
        $this->model->borrarUsuarioZona($data);
    }

    public function actualizarUsuarioZona(){
        $data['id'] = $_POST['id'];
        $data['identificacion'] = $_POST['identificacion'];
        $data['idzona'] = $_POST['idzona'];
        $data['idlineaprecio'] = $_POST['idlineaprecio'];
       echo json_encode($this->model->actualizarUsuarioZona($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}