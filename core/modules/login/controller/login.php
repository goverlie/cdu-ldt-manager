<?php
use \core\libs as core;


class Login extends core\Controller {
	
	function __construct() {
		parent::__construct();
		if (core\Session::get('loggedIn')) {
			header('location: '.URL.'dashboard');
			exit;
		}
	}
	function index () {
		$this->view->title = "Login";
		$this->view->errorMessage = core\Session::get('errorMessage');

		$this->view->render('header');
		$this->view->renderCoreModule('login');
		$this->view->render('footer');

		$this->view->errorMessage = core\Session::uset('errorMessage');

	}
	
	function run () {
		try {
			$this->model->run();
		} catch (PDOException $e) {
			$this->view->errorMessage = core\Session::set('errorMessage',$e);
		}
	}
	
	
}
