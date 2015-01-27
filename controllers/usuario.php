<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
Session::init();
class usuario extends Controller {

    function __construct() {
        parent::__construct();    
    }
    
    function index() { 
        if(isset($_POST['tipocliente']) && !empty($_POST['tipocliente'])){
            $data = 'WHERE tipocliente = '.$_POST['tipocliente'];   
        }else{
            $data = '';
        }

      echo json_encode($this->model->listaDeUsuarios($data));
    }

    public function listaDeUsuarios(){
      echo json_encode($this->model->listaDeUsuarios());
    }

    public function crearUsuario(){
      $data['usuario'] = $_POST['usuario'];
      $data['password'] = $_POST['password'];
      $data['identificacion'] = $_POST['identificacion'];
      $data['tipoidentificacion'] = $_POST['tipoidentificacion'];
      $data['nombres'] = $_POST['nombres'];
      $data['apellidos'] = $_POST['apellidos'];
      $data['direccion'] = $_POST['direccion'];
      $data['telefono1'] = $_POST['telefono1'];
      $data['telefono2'] = $_POST['telefono2'];
      $data['telefono3'] = $_POST['telefono3'];
      $data['descuento1'] = $_POST['descuento1'];
      $data['descuento2'] = $_POST['descuento2'];
      $data['descuento3'] = $_POST['descuento3'];
      $data['departamento'] = $_POST['departamento'];
      $data['ciudad'] = $_POST['ciudad'];
      $data['tipocliente'] = $_POST['tipocliente'];
      $data['email'] = $_POST['correo'];
      $data['estado'] = $_POST['estado'];
      
      echo json_encode($this->model->crearUsuario($data));
    }

    public function borrarUsuario(){
      $data['id'] = $_POST['id'];

      $this->model->borrarUsuario($data);
    }

    public function actualizarUsuario(){
      $data['id'] = $_POST['id'];
      $data['usuario'] = $_POST['usuario'];
      $data['clave'] = $_POST['password'];
      $data['identificacion'] = $_POST['identificacion'];
      $data['tipoidentificacion'] = $_POST['tipoidentificacion'];
      $data['nombres'] = $_POST['nombres'];
      $data['apellidos'] = $_POST['apellidos'];
      $data['direccion'] = $_POST['direccion'];
      $data['telefono1'] = $_POST['telefono1'];
      $data['telefono2'] = $_POST['telefono2'];
      $data['telefono3'] = $_POST['telefono3'];
      $data['descuento1'] = $_POST['descuento1'];
      $data['descuento2'] = $_POST['descuento2'];
      $data['descuento3'] = $_POST['descuento3']; 
      $data['departamento'] = $_POST['departamento'];
      $data['ciudad'] = $_POST['ciudad'];
      $data['tipocliente'] = $_POST['tipocliente'];
      $data['email'] = $_POST['correo'];
      $data['estado'] = $_POST['estado'];
      
      $this->model->actualizarUsuario($data);
    }
    
    public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 

    function userAuth(){
       $this->model->userAuth();
    }
    
    function close(){
      header('content-type: application/json; charset=utf-8');
       
      if(Session::get('loggedIn')){
       	  Session::destroy();
	        echo isset($_GET['callback'])? "{$_GET['callback']}({'session':false})" : json_encode(array('session' => false));
        return;
        
      }else{
	        echo isset($_GET['callback'])? "{$_GET['callback']}({'session':false})" : json_encode(array('session' => false));
       }

    }

    function checksession(){
      header('content-type: application/json; charset=utf-8');
      if(Session::get('loggedIn')){
          echo isset($_GET['callback'])? "{$_GET['callback']}({'session':true, 'identificacion':".Session::get('identificacion')."})" : json_encode(array('session' => true, 'identificacion' => Session::get('identificacion')));
      }else{
          echo isset($_GET['callback'])? "{$_GET['callback']}({'session':false})" : json_encode(array('session' => false));
       }
    }
    
    function run(){
        if($this->model->run()){
            echo json_encode(array('init' => 'true'));
        }else{
            echo json_encode(array('init' => 'false'));
        }
    }
    

}