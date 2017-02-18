<?php
use \core\libs as core;

class Production_Report extends core\Controller{
	
	function __construct() {
		parent::__construct();
		\core\util\Auth::handleLogin();
				
		//$this->view->js = array('dashboard/js/default.js');
	}
	
	function index () {
		$this->view->title = "Production Report";
		$this->view->facultyList = $this->model->getFacultyList();
		$this->view->statusList = $this->model->getStatusList();
		$this->view->unitStatusList = $this->model->getUnitStatusList();

		$this->view->errorMessage = core\Session::get('errorMessage');

		$this->view->render('header');
		$this->view->renderCoreModule('production_report');
		$this->view->render('footer');

		$this->view->errorMessage = core\Session::uset('errorMessage');

	}
	
	public function createUnitStatus() {
		$data = array();
		$data['status_date'] = $_POST['status_date'];
		$data['faculty_id'] = $_POST['faculty_id'];
		$data['status_id'] = $_POST['status_id'];
		$data['no_units'] = $_POST['no_units'];
		$data['percent'] = $_POST['percent'];
		
		// @TODO: Do your error checking
		
		try {
			$this->model->createUnitStatus($data);
		} catch (PDOException $e) {
					core\Session::set('errorMessage', $e->getMessage());
		}
		header('location: '.URL.'production_report');
	}
	
	public function edit($id) {
		
		$this->view->title = "Edit User";
		//fetch individual user
		$this->view->user = $this->model->getUser($id);
		
		$this->view->render('header');
		$this->view->renderCoreModule('production_report','edit');
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
	
		$this->model->editSave($data);

		header('location: '.URL.'user');

	}
	
	public function deleteUnitStatus($status_date,$faculty_id,$status_id) {
		try {
			$this->model->deleteUnitStatus($status_date,$faculty_id,$status_id);
		} catch (PDOException $e) {
			core\Session::set('errorMessage', $e->getMessage());
		}
		header('location: '.URL.'production_report');
	}
}
