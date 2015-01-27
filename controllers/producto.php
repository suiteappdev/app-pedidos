<?php
class Producto extends Controller {
    
    function __construct() {
        parent::__construct();
        header('content-type: application/json; charset=utf-8');
    }
    
    function index() {
        echo json_encode($this->model->ObtenerListaDeProductos());
        /*$output=null;

        $data = array(
            'familia1'=>$_GET['idfamilia1'],
            'familia2'=>$_GET['idfamilia2']
            );

        foreach ($this->model->ObtenerListaDeProductos($data) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $productList = json_encode($output);
        
	    echo isset($_GET['callback'])? "{$_GET['callback']}($productList)" : $productList;*/

    }
    
    function obtenerProducto(){
        $output=null;

        $data['id'] = $_GET['id'];
        $data['linea'] = $_GET['linea'];

        foreach ($this->model->ObtenerProducto($data) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $product = json_encode($output);
        
	    echo isset($_GET['callback'])? "{$_GET['callback']}($product)" : $product;
    }

    function ObtenerProductosCategorias(){
        $output=null;
        
        $data['familia1'] = $_GET['familia1'];
        $data['familia2'] = $_GET['familia2'];
        $data['familia3'] = $_GET['familia3'];
        $data['familia4'] = $_GET['familia4'];
        $data['familia5'] = $_GET['familia5'];
        $data['linea'] = $_GET['linea'];

        foreach ($this->model->ObtenerProductosCategoria($data) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $product = json_encode($output);
        
        echo isset($_GET['callback'])? "{$_GET['callback']}($product)" : $product;
    }
    
    function ObtenerTodo(){

        $output=null;
        
        $data['familia1'] = $_GET['familia1'];
        $data['familia2'] = $_GET['familia2'];
        $data['familia3'] = $_GET['familia3'];
        $data['familia4'] = $_GET['familia4'];
        $data['familia5'] = $_GET['familia5'];
        $data['linea'] = $_GET['linea'];
        

       foreach ($this->model->ObtenerTodo($data) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $product = json_encode($output);
        
        echo isset($_GET['callback'])? "{$_GET['callback']}($product)" : $product;
    }

    function ObtenerLineas(){
        header('content-type: application/json; charset=utf-8');

        $output=null;

       foreach ($this->model->ObtenerLineas($_GET['identificacion']) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }

        
        $lineas = json_encode($output);
        
        echo isset($_GET['callback'])? "{$_GET['callback']}($lineas)" : $lineas;
    }

    public function crearProducto(){
        if(isset($_FILES['Image'])){
            if($_FILES['Image']['size'] > 1048576){
                echo json_encode(array(
                    'error' =>'la imagen supera el tamaño ideal'
                    ));

                return;
            }

            $image = $_FILES['Image'];

            $img = new Image($image, md5(Session::get('username').time()), UPLOADS_DIR);
            $img->Create();
            $img->resize(226);

            $data['image'] = $img->toUrl;
        }

        $data['descripcion'] = $_POST['Descripcion'];
        $data['estado'] = $_POST['Estado'];
        $data['embalaje'] = $_POST['Embalaje'];
        $data['familia1'] = $_POST['Familia1'];
        $data['familia2'] = $_POST['Familia2'];
        $data['familia3'] = $_POST['Familia3'];
        $data['familia4'] = $_POST['Familia4'];
        $data['familia5'] = $_POST['Familia5'];

        $data['ProductoPrecio']  = json_decode(stripslashes($_POST['ProductoPrecio']));
        $data['ListaReferencias'] = json_decode(stripslashes($_POST['ListaReferencias']));

        echo json_encode($this->model->crearProducto($data));
    }

    public function obtenerPreciosProducto(){
        $data['idproducto'] = $_POST['idproducto'];
        echo json_encode($this->model->obtenerPreciosProducto($data));
    }

    public function ObtenerProductoReferencia(){
        $data['idproducto'] = $_POST['idproducto'];
        echo json_encode($this->model->ObtenerProductoReferencia($data));
    }

    public function actualizarProducto(){
        if(isset($_FILES['Image'])){
            if($_FILES['Image']['size'] > 1048576){
                echo json_encode(array(
                    'error' =>'la imagen supera el tamaño ideal'
                    ));

                return;
            }

            $image = $_FILES['Image'];

            $img = new Image($image, md5(Session::get('username').time()), UPLOADS_DIR);
            $img->Create();
            $img->resize(226);

            $data['image'] = $img->toUrl;
        }

        $data['idproducto'] = $_POST['Idproducto'];
        $data['descripcion'] = $_POST['Descripcion'];
        $data['estado'] = $_POST['Estado'];
        $data['embalaje'] = $_POST['Embalaje'];
        $data['familia1'] = $_POST['Familia1'];
        $data['familia2'] = $_POST['Familia2'];
        $data['familia3'] = $_POST['Familia3'];
        $data['familia4'] = $_POST['Familia4'];
        $data['familia5'] = $_POST['Familia5'];

        $data['ProductoPrecio']  = json_decode(stripslashes($_POST['ProductoPrecio']));
        $data['ListaReferencias'] = json_decode(stripslashes($_POST['ListaReferencias']));

        echo json_encode($this->model->actualizarProducto($data));  
    }

    public function buscarProductoPorColumna(){
        $data['col'] = $_POST['col'];
        $data['val'] = $_POST['val'];
        echo json_encode($this->model->buscarProductoPorColumna($data));
    }

    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 

}