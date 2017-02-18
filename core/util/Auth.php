<?php
namespace core\util;

class Auth {
	public static function handleLogin() {
		if (isset($_SESSION['loggedIn'])) $logged = $_SESSION['loggedIn'];
			else $logged = false;
	
		if ($logged == false) {
			session_destroy();
			header('location: '.URL.'login');
			exit;
		}
	}
}
