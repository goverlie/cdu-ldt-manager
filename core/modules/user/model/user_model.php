<?php
use \core\libs as core;

class User_Model extends core\Model {
	
	private $_salt; // Salt used for user passwords
	
	 function __construct() {
		 parent::__construct();
	 }
	
	public function userList () {
		return $this->db->select('SELECT user_id, username, firstname, lastname, email FROM ' . DB_TABLE_PREFIX . 'users');
	}
	
	public function getUser ($id) {
		return $this->db->select1('SELECT user_id, username, firstname, lastname, email FROM ' . DB_TABLE_PREFIX . 'users WHERE user_id = :id', array(':id' => $id));
	}
	
	public function create ($data) {
		/*
		A salt is randomly generated here to protect again brute force attacks
		 and rainbow table attacks.  The following statement generates a hex
		 representation of an 8 byte salt.  Representing this in hex provides
		 no additional security, but makes it easier for humans to read.
		 For more information:
		 http://en.wikipedia.org/wiki/Salt_%28cryptography%29
		 http://en.wikipedia.org/wiki/Brute-force_attack
		 http://en.wikipedia.org/wiki/Rainbow_table
		*/
		$this->_salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
		
		/*
		 This hashes the password with the salt so that it can be stored securely
		 in your database.  The output of this next statement is a 64 byte hex
		 string representing the 32 byte sha256 hash of the password.  The original
		 password cannot be recovered from the hash.  For more information:
		 http://en.wikipedia.org/wiki/Cryptographic_hash_function
		 */
		$password = hash('sha256', $data['password'] . $this->_salt);
		
		/*
		 Next we hash the hash value 65536 more times.  The purpose of this is to
		 protect against brute force attacks.  Now an attacker must compute the hash 65537
		 times for each guess they make against a password, whereas if the password
		 were hashed only once the attacker would have been able to make 65537 different
		 guesses in the same amount of time instead of only one.
		*/
		for($round = 0; $round < 65536; $round++) {
			$password = hash('sha256', $password . $this->_salt);
		}
		
		$postData =  array (
			'username' => $data['username'],
			'password' => $password,
			'salt' => $this->_salt,
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'email' => $data['email'],
			'regIP' => $data['regIP'],
			'date_created' => $data['date_created']
		);
		
		foreach ($postData as $key => $value) {
			if (empty($value)&& $value != '0') {
				unset($postData[$key]);
			}
		}
		
		$this->db->insert(DB_TABLE_PREFIX . 'users', $postData);
	
	}
	
	public function editSave ($data) {

		$postData = array (
			'username' => $data['username'],
			'password' => $data['password'],
			'salt' => $this->_salt,
			'firstname' => $data['firstname'],
			'lastname' => $data ['lastname'],
			'email' => $data['email'],
			'date_modified' => date("Y-m-d H:i:s")
		);
		
		// If the field is left empty - do not update it ((should be specific to password only - UPDATE THIS))
		foreach ($postData as $key => $value) {
			if (empty($value)&& $value != '0') {
				unset($postData[$key]);
			}
		}
		
		if (isset($postData['password'])) {
			// Create salt
			$this->_salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
			$postData['salt'] = $this->_salt;
			
			// Hash password using salt
			$password = hash('sha256', $postData['password'] . $this->_salt);
			
			// Hash again many times
			for($round = 0; $round < 65536; $round++) {
				$password = hash('sha256', $password . $this->_salt);
			}
			
			// set password;
			$postData['password'] = $password;
		} else {
			if (isset($postData['salt'])) unset($postData['salt']);
		}
		
		$this->db->update(DB_TABLE_PREFIX . 'users', $postData ,"`user_id` = {$data['user_id']}");

	}
	
	public function delete($id) {
		
		/* Don't delete admin
		$r = $this->db->select1('SELECT permission_level FROM or_users WHERE id = :id',array(':id' => $id));
				
		if ($r['permission_level']==0) {
			return false;
		}
		*/
		$this->db->delete(DB_TABLE_PREFIX . "users","user_id = $id");
	}
}
