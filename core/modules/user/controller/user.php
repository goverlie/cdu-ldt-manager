<?php
use \core\libs as core;

class User extends core\Controller{
	
	function __construct() {
		parent::__construct();
		\core\util\Auth::handleLogin();
				
		//$this->view->js = array('dashboard/js/default.js');
	}
	
	function index () {
		$this->view->title = "Add User";
		$this->view->userList = $this->model->userList();
		$this->view->errorMessage = core\Session::get('errorMessage');

		$this->view->render('header');
		$this->view->renderCoreModule('user');
		$this->view->render('footer');

		$this->view->errorMessage = core\Session::uset('errorMessage');

	}
	
	public function create() {
		$data = array();
		$data['username'] = $_POST['username'];
		$data['password'] = $_POST['password'];
		$data['firstname'] = $_POST['firstname'];
		$data['lastname'] = $_POST['lastname'];
		$data['email'] = $_POST['email'];
		$data['date_created'] = date("Y-m-d H:i:s");
		$data['regIP'] = $_SERVER['REMOTE_ADDR'];
		
		// @TODO: Do your error checking
		
		try {
			$this->model->create($data);
		} catch (PDOException $e) {
					core\Session::set('errorMessage', $e->getMessage());
		}
		header('location: '.URL.'user');
	}
	
	public function edit($id) {
		
		$this->view->title = "Edit User";
		//fetch individual user
		$this->view->user = $this->model->getUser($id);
		
		$this->view->render('header');
		$this->view->renderCoreModule('user','edit');
		$this->view->render('footer');
		
	}

	public function editSave($id) {
		$data = array();
		$data['user_id'] = $id;
		$data['username'] = $_POST['username'];
		$data['password'] = $_POST['password'];
		//$data['permission_level'] = $_POST['permission_level'];
		$data['firstname'] = $_POST['firstname'];
		$data['lastname'] = $_POST['lastname'];
		$data['email'] = $_POST['email'];
	
		$this->model->editSave($data);
		header('location: '.URL.'user');

	}
	
	public function delete($id) {
		$this->model->delete($id);
		header('location: '.URL.'user');
	}
}
