<?php
use \core\libs as core;

class Dashboard extends core\Controller{
	
	function __construct() {
		parent::__construct();
		//replace this with current login system
		\core\util\Auth::handleLogin();
		$this->view->js = array('core/modules/dashboard/views/js/default.js');
	}
	
	function index () {
		$this->view->title = "Dashboard";
		
		$this->view->render('header');
		$this->view->renderCoreModule('dashboard');
		$this->view->render('footer');
	}
	
	function logout () {
		core\Session::destroy();
		$this->model->saveTheme();
		header('location: '.URL.'login');
		exit;
	}
	
	function xhrInsert() {
		$this->model->xhrInsert();
	}

	function xhrGetListings() {
		$this->model->xhrGetListings();
	}
	
	function xhrDeleteListing() {
		$this->model->xhrDeleteListing();
	}
	
}
