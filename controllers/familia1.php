<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class familia1 extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo json_encode($this->model->listaDeFamilia1());
    }

    public function crearFamilia1(){
        if(isset($_FILES['image'])){
            if($_FILES['image']['size'] > 1048576){
                echo json_encode(array(
                    'error' =>'la imagen supera el tamaño ideal'
                    ));

                return;
            }

            $image = $_FILES['image'];

            $img = new Image($image, md5(Session::get('username').time()), UPLOADS_DIR);
            $img->Create();
            $img->resize(300);

            $data['image'] = $img->toUrl;
        }

        $data['descripcion'] = $_POST['descripcion'];
        $data['estado'] = $_POST['estado'];
        $data['success'] = 'guardado correctamente.';
        $data['id'] = $this->model->crearFamilia1($data);

        echo json_encode($data);
    }

    public function listaDeFamila1(){
        echo json_encode($this->model->listaDeFamilia1());
    }

    public function borrarFamilia1(){
        $data['id'] = $_POST['id'];
        $this->model->borrarFamilia1($data);
    }

    public function actualizarFamilia1(){
        if(isset($_FILES['image'])){
            if($_FILES['image']['size'] > 1048576){
                echo json_encode(array(
                    'error' =>'la imagen supera el tamaño ideal'
                    ));

                return;
            }

            $image = $_FILES['image'];

            $img = new Image($image, md5(Session::get('username').time()), UPLOADS_DIR);
            $img->Create();
            $img->resize(300);

            $data['image'] = $img->toUrl;
        }

        $data['descripcion'] = $_POST['descripcion'];
        $data['estado'] = $_POST['estado'];
        $data['id'] = $_POST['id'];
        
        $this->model->actualizarFamilia1($data);
        $data['success'] = 'actualizado correctamente.';


        echo json_encode($data);
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}