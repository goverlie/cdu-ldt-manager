<?php
use \core\libs as core;

class Dashboard_Model extends core\Model {
	function __construct() {
		parent::__construct();
	}
	
	public function saveTheme () {
		$postData = array(
			'theme_id' => core\Session::get('theme_id')
		);
		$this->db->update(DB_TABLE_PREFIX . 'users', $postData ,"`user_id` = " . core\Session::get('user_id'));
	}

	function xhrInsert() {
		
		$text = $_POST['text'];
		
		//Don't continue if no text was entered
		if ($text == '') return false;
		
		$this->db->insert(DB_TABLE_PREFIX . "_test",array('text' => $text));
		
		$data = array('text' => $text, 'note_id' => $this->db->lastInsertId());
		echo json_encode($data);
	}
	function xhrGetListings () {
		$data = $this->db->select("SELECT * FROM ". DB_TABLE_PREFIX . "test");
		echo json_encode($data);
	}
	
	function xhrDeleteListing () {
		$id = (int) $_POST['id'];
		$this->db->delete(DB_TABLE_PREFIX . "test","note_id = $id");
	}
}
