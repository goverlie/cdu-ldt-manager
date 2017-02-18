<?php
use \core\libs as core;

class Note extends core\Controller{
	
	function __construct() {
		parent::__construct();
		\core\util\Auth::handleLogin();
	}
	
	function index () {
		$this->view->title = "Notes";
		$this->view->noteList = $this->model->noteList();
		
		$this->view->render('header');
		$this->view->renderCoreModule('note');
		$this->view->render('footer');
	}
	
	public function create() {
		$data = array(
			'title' => $_POST['title'],
			'content' => $_POST['content']
		);
		
		$this->model->create($data);
		header('location: '.URL.'note');
	}
	
	public function edit($id) {
		
		//fetch individual user
		$this->view->title = "Edit Note";
		$this->view->note = $this->model->getNote($id);
		
		$this->view->render('header');
		$this->view->renderCoreModule('note','edit');
		$this->view->render('footer');
		
	}

	public function editSave($id) {
		$data = array(
			'user_id' => Session::get('user_id'),
			'note_id' => $id,
			'title' => $_POST['title'],
			'content' => $_POST['content']
		);
	
		$this->model->editSave($data);

		header('location: '.URL.'note');

	}
	
	public function delete($id) {
		$this->model->delete($id);
		header('location: '.URL.'note');
	}
}
