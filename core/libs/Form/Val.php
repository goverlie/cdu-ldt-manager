<?php
namespace core\libs\Form;


class Val {
	public function __construct() {

	}
	
	public function minlength($data, $arg) {
		if (strlen($data) < $arg) {
			return "Minimum length is $arg.";
		}
	}
	
	public function maxlength($data, $arg) {
		if (strlen($data) > $arg) {
			return "Maximum length is $arg.";
		}
	}
	
	public function digit($data) {
		if (!ctype_digit($data)) {
			return "Your string must be a digit";
		}
	}
	public function float($data) {
		if (!is_float($data)) {
			return "Your string must be a float".$data;
		}
	}
	public function __call($name, $args) {
		throw new Exception("$name does not exist inside of: " . __CLASS__);
	}
}
