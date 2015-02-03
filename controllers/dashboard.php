<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();

        $this->view->js = array(
            'dashboard/js/init.js',
            'dashboard/js/accounting.js',
            'dashboard/js/frm-pais.js',
            'dashboard/js/frm-departamento.js',
            'dashboard/js/frm-ciudad.js',
            'dashboard/js/frm-tipoCliente.js',
            'dashboard/js/frm-tipoIdentificacion.js',
            'dashboard/js/frm-zona.js',
            'dashboard/js/frm-ubicacion.js',
            'dashboard/js/frm-usuario.js',
            'dashboard/js/frm-estadoCliente.js',
            'dashboard/js/frm-UsuarioZona.js',
            'dashboard/js/frm-lineaPrecio.js',
            'dashboard/js/frm-producto.js',
            'dashboard/js/frm-referencia.js',
            'dashboard/js/frm-estadoProducto.js',
            'dashboard/js/frm-familia1.js',
            'dashboard/js/frm-familia2.js',
            'dashboard/js/frm-familia3.js',
            'dashboard/js/frm-familia4.js',
            'dashboard/js/frm-familia5.js',
            'dashboard/js/frm-estadoCategoria.js',
            'dashboard/js/frm-impuesto.js',
            'dashboard/js/frm-pedido.js',
            'dashboard/js/frm-estadoPedido.js'
            );
    }
    
    function index(){
        $this->view->title = APP_INDEX_TITLE;
        $this->view->render('header');
        $this->view->render('dashboard/index');
        $this->view->render('footer');
    }
    
    function logout(){
        Session::destroy();
        header('location: '.URL);
    }

}