<?php
namespace core\libs;

class Session {
	function __construct () {}
	
	public static function init () {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}
	
	public static function hasSessionStarted () {
		
		if (session_status() == PHP_SESSION_NONE) {
			return false;
			exit;
		}
		
		return true;
		
	}
	
	public static function set ($key, $value) {
		try {
			$_SESSION[$key] = $value;
		}
		catch (Throwable $t) {
			die("dying... " . $t);
		}
	}
	
	public static function get ($key) {
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
	}

	public static function uset ($key) {
		if (isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
		}
	}
	
	public static function destroy () {
		//also unset anything unset($_SESSION);
		
		session_destroy();
	}
}
