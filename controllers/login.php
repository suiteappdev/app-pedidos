<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Controller {

    function __construct() {
        parent::__construct();    
    }
    
    function index() {    
        $this->view->title = 'Login';
        $this->view->render('header');
        $this->view->render('login/index');
        $this->view->render('footer');
    }

    function Auth(){
        $this->model->userAuth();
    }
}