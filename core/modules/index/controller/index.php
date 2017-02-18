<?php
use \core\libs as core;

class Index extends core\Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index () {
		//die("index");
		if (core\Session::get('loggedIn')) {
			header('location: '.URL.'dashboard');
			exit;
		}
		$this->view->render('header');
		$this->view->renderCoreModule('index','index');
		$this->view->render('footer');
	}
}
