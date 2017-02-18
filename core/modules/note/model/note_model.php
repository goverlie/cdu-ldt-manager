<?php
use \core\libs as core;

class Note_Model extends core\Model {
	 function __construct() {
		 parent::__construct();
	 }
	
	public function noteList () {
		return $this->db->select('SELECT * FROM ' . DB_TABLE_PREFIX . 'notes WHERE user_id = :user_id',array(':user_id' => core\Session::get('user_id')));
	}
	
	public function getNote ($id) {
		return $this->db->select1('SELECT * FROM ' . DB_TABLE_PREFIX . 'notes WHERE user_id = :user_id AND note_id = :note_id', array(':note_id' => $id, ':user_id' => core\Session::get('user_id')));
	}
	
	public function create ($data) {
		$postData =  array (
			'user_id' => core\Session::get('user_id'),
			'title' => $data['title'],
			'content' => $data['content'],
			'date_added' => date('Y-m-d H:i:s')
		);
		
		$this->db->insert(DB_TABLE_PREFIX . 'notes', $postData);
	
	}
	
	public function editSave ($data) {
		
		$postData =  array (
			'title' => $data['title'],
			'content' => $data['content'],
		);
		
		// If the field is left empty - do not update it ((should be specific to password only - UPDATE THIS))
		foreach ($postData as $key => $value) {
			if (empty($value)) {
				unset($postData[$key]);
			}
		}
		
		$this->db->update(DB_TABLE_PREFIX . 'notes', $postData ,"`note_id` = ".$data['note_id']." AND user_id = " . core\Session::get('user_id'));

	}
	
	public function delete($id) {
			$this->db->delete(DB_TABLE_PREFIX . "notes","note_id = $id AND user_id = " . core\Session::get('user_id'));
	}
}
