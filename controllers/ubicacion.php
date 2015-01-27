<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class ubicacion extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        if(isset($_POST['idzona']) && !empty($_POST['idzona'])){
            $data = 'and zon.id ='.$_POST['idzona'];   
        }else{
            $data = '';
        }

        echo json_encode($this->model->listaDeUbicaciones($data));
    }

    public function crearUbicacion(){
        $data['idzona'] = $_POST['idzona'];
        $data['iddepartamento'] = $_POST['iddepartamento'];
        echo json_encode(array('id' => $this->model->crearUbicacion($data)));
    }

    public function listaDeUbicaciones(){
        echo json_encode($this->model->listaDeUbicaciones());
    }

    public function borrarUbicacion(){
        $data['id'] = $_POST['id'];
        $this->model->borrarUbicacion($data);
    }

    public function actualizarUbicacion(){
        $data['id'] = $_POST['id'];
        $data['iddepartamento'] = $_POST['iddepartamento'];
        $data['idzona'] = $_POST['idzona'];
       echo json_encode($this->model->actualizarUbicacion($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}