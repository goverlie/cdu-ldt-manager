<?php
use \core\libs as core;

class Bad extends core\Controller {

	function __construct() {
		parent::__construct();
	}

	public function index () {
		$this->view->msg = "This page doesn't exist.";
		$this->view->title = "Error";

		$this->view->render('header');
		$this->view->renderCoreModule('bad','index');
		$this->view->render('footer');
	}
}
