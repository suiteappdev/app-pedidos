<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Index extends Controller {

    function __construct() {
        parent::__construct();
        
        $this->view->js = array(
            'index/js/jquery.easing.1.3.js',
            'index/js/frm-login.js'
            );
    }
    
    function index() {
        //echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
        //echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);
        //$this->view->empresa = $this->model->ObtenerEmpresa(EMPRESA);
        $this->view->title = APP_INDEX_TITLE;
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');
    }

    function loadhtml(){
       // $formName = $_POST['formName'];
         return $this->view->render('index/form/login/frm_login');
    }

}