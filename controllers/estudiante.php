<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Estudiante extends Controller{
	
	function __construct(){
        parent::__construct();
        Auth::handleLogin();
	}

	function create(){
		$data = array(
			'message'=> input::clear($_POST['txtMessage'], 'string'),
			'group'=>input::clear($_POST['txtGroup'],'string'),
			'subject'=>input::clear($_POST['txtsubject'],'string')
			);

        $lastId = $this->model->create($data);
        $data['id'] = $lastId;
        
        echo json_encode($data);
	}

	function MessageList(){
		$data = $this->model->messageList();

		echo json_encode($data);
	}

	function delete(){
		$data = array(
			'id'=> input::clear($_POST['id'], 'string')
			);
		
        $this->model->delete($data);
	}

	function loadView(){
        if(input::is_ajax_request() && isset($_POST['view'])){
        	$viewName = input::clear($_POST['view'], 'string');
			echo $this->view->render('Estudiante/form/'.$viewName.'');        	
        }else{
        	die('invalid request');
        }
	}

	function update(){
		$data = array(
			'message'=> input::clear($_POST['txtMessage'], 'string'),
			'description'=>input::clear($_POST['txtSubject'],'string')
			);

		$this->model->update($data, input::clear($_POST['id'], 'string'));
	}
}