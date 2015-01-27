<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_Model extends Model
{
    public function __construct(){
        parent::__construct();
    }

    public function userAuth(){
        header('content-type: application/json; charset=utf-8');

        if(isset($_GET['callback'])){
            $sth = $this->db->prepare("SELECT identificacion, usuario FROM clientes WHERE 
                usuario= :login AND clave=:password and tipocliente = 3");            
        }else{
            $sth = $this->db->prepare("SELECT identificacion, usuario FROM clientes WHERE 
                    usuario= :login AND clave=:password and tipocliente = 1 or tipocliente = 4");            
        }
        

        $sth->execute(array(
            ':login' => $_GET['txtLoginUsername'],
            ':password' => $_GET['txtLoginPassword']
        ));

        $data = $sth->fetch();

        if($data){
            Session::init();
            Session::set('loggedIn', true);
            Session::set('username', $data['usuario']);
            Session::set('identificacion', $data['identificacion']);
            echo isset($_GET['callback'])? "{$_GET['callback']}({'session':true, 'identificacion':{$data['identificacion']}})" : json_encode(array('session' => true, 'identificacion' => $data['identificacion']));
        }else{
            echo isset($_GET['callback'])? "{$_GET['callback']}({'session':false})" : json_encode(array('session' => false));
        }
    }

    public function listaDeUsuarios($filtro){
        return $this->db->select('SELECT * FROM clientes '.$filtro);
    }

    public function crearUsuario($data){
        return $this->db->insert('clientes',
                array(
                    'usuario' =>$data['usuario'],
                    'clave' =>$data['password'],
                    'identificacion' =>$data['identificacion'],
                    'tipoidentificacion' =>$data['tipoidentificacion'],
                    'nombres' =>$data['nombres'],
                    'apellidos' =>$data['apellidos'],
                    'direccion' =>$data['direccion'],
                    'telefono1' =>$data['telefono1'],
                    'telefono2' =>$data['telefono2'],
                    'telefono3' =>$data['telefono3'],
                    'descuento1' =>$data['descuento1'],
                    'descuento2' =>$data['descuento2'],
                    'descuento3' =>$data['descuento3'],
                    'departamento' =>$data['departamento'],
                    'ciudad' =>$data['ciudad'],
                    'tipocliente' =>$data['tipocliente'],
                    'email' =>$data['email'],
                    'estado' =>$data['estado']
                    )
            );
    }

    public function actualizarUsuario($data){
        $rows = $this->db->update('clientes',
                array(
                    'usuario' => $data['usuario'],
                    'clave' => $data['clave'],
                    'identificacion' => $data['identificacion'],
                    'tipoidentificacion' => $data['tipoidentificacion'],
                    'nombres' => $data['nombres'],
                    'apellidos' => $data['apellidos'],
                    'direccion' => $data['direccion'],
                    'telefono1' => $data['telefono1'],
                    'telefono2' => $data['telefono2'],
                    'telefono3' => $data['telefono3'],
                    'descuento1' =>$data['descuento1'],
                    'descuento2' =>$data['descuento2'],
                    'descuento3' =>$data['descuento3'],
                    'departamento' => $data['departamento'],
                    'ciudad' => $data['ciudad'],
                    'tipocliente' => $data['tipocliente'],
                    'email' => $data['email'],
                    'estado' => $data['estado']
                    ),
                 'id ='.$data['id']
            );
            
            if($rows->rowCount() > 0){
           	echo json_encode(array('success'=>'usuario actualizado correctamente'));
            }else{
		echo json_encode(array('error'=>'ocurrio un error al actualizar'));
            }
    }

    public function borrarUsuario($data){
        $this->db->delete('clientes','id='.$data['id'], 1);
    }
    
}