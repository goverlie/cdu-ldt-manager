<?php
namespace core\libs;

class Theme {
	
	private $_db = null;
	
	/* Please use init  */
	function __construct () {
		$this->_db = new Database();
	}
	
	public function init () {
	}
	
	public function isThemeSet () {
		return true;
		//return empty(Session::get('theme')) ? false : true;
				
	}
	
	public function getAllThemes() {
		return $this->_db->select('SELECT * from ' . DB_TABLE_PREFIX . 'themes');
	}
	
	public function getTheme($theme_id = 1) {
		return $this->_db->select('SELECT * from ' . DB_TABLE_PREFIX . 'themes WHERE theme_id =' . $theme_id);
	}
		
	public function getThemeName() {
		$theme = $this->_db->select1('SELECT common_name
							FROM ' . DB_TABLE_PREFIX . 'users u
							INNER JOIN ' . DB_TABLE_PREFIX . 'themes t
							ON u.theme_id = t.theme_id
							WHERE user_id = '. Session::get('user_id'));
		
		return $theme['common_name'];
		
	}
	
	public function saveCurrentTheme () {
		try {
			$postData = array(
				'theme_id' => Session::get('theme_id')
			);
			$this->_db->update(DB_TABLE_PREFIX . 'users', $postData ,"`user_id` = " . Session::get('user_id'));
		}
		catch (Throwable $t) {
				
			}
		}
	
	public function saveTheme () {
		
	}

	public function get ($data = array()) {
		try {
			$theme = $this->_db->select1("select theme_id from f_users where user_id = :user_id",
				array(":user_id"=> Session::get("user_id"))
			);
			
			return $theme['theme_id'];

		}
		catch (Throwable $t) {
			die("Couldn't get theme..");
		}
	}
}
