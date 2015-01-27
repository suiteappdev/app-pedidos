<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class familia3 extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        if(isset($_POST['idfamilia']) && !empty($_POST['idfamilia'])){
            $data['idfamilia'] = $_POST['idfamilia'];
        }else{
            $data['idfamilia'] = null;
        }

        echo json_encode($this->model->listaDeFamilia3($data));
    }

    public function crearFamilia3(){
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
        $data['familia'] = $_POST['familia'];
        $data['estado'] = $_POST['estado'];
        $data['id'] = $this->model->crearFamilia3($data);
        $data['success'] = 'guardado correctamente';

        echo json_encode($data);
    }

    public function listaDeFamila3(){
        echo json_encode($this->model->listaDeFamilia3());
    }

    public function borrarFamilia3(){
        $data['id'] = $_POST['id'];
        $this->model->borrarFamilia3($data);
    }

    public function actualizarFamilia3(){
        if(isset($_FILES['image'])){
            $image = $_FILES['image'];

            if($image['size'] > 1048576){
                echo json_encode(array(
                    'error' =>'la imagen supera el tamaño ideal'
                    ));

                return;
            }

            $img = new Image($image, md5(Session::get('username').time()), UPLOADS_DIR);
            $img->Create();
            $img->resize(300);

            $data['image'] = $img->toUrl;
        }



        $data['id'] = $_POST['id'];
        $data['estado'] = $_POST['estado'];
        $data['familia'] = $_POST['familia'];
        $data['success'] = 'actualizado correctamente';
        $data['descripcion'] = $_POST['descripcion'];

        $this->model->actualizarFamilia3($data);
       
        echo json_encode($data);
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}