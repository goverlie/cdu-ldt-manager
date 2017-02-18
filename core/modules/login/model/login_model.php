<?php
use \core\libs as core;

class Login_Model extends core\Model {
	 function __construct() {
		 parent::__construct();
	 }
	
	public function run () {
		
		$data = $this->db->select1('SELECT * FROM ' . DB_TABLE_PREFIX . 'users WHERE username = :username', array(':username' => $_POST['username']));
		
		
		$check_password = hash('sha256', $_POST['password'] . $data['salt']);
			for($round = 0; $round < 65536; $round++) {
				$check_password = hash('sha256', $check_password . $data['salt']);
			}

			if($check_password === $data['password']) {
				//log in
				
				//set session variables
				core\Session::set('theme_id',$data['theme_id']);
				core\Session::set('loggedIn', true);
				core\Session::set('user_id',$data['user_id']);
				//Session::set('role',$data['permission_level']);

				//update login time
				$postData = array (
					'last_login' => date("Y-m-d H:i:s")
				);
				try {
					$this->db->update(DB_TABLE_PREFIX . 'users', $postData ,"`user_id` = {$data['user_id']}");
				} catch (PDOException $e) {
					return;
				}
				//navigate to dashboard
				header('location: '.URL.'dashboard');
			} else {
				//core\Session::destroy(); //why is this needed
				core\Session::set('errorMessage','Incorrect Username/Password');
				header('location: '.URL.'login');
			}
	}
}
