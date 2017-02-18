<?php
namespace core\libs;

class Model {
	function __construct () {
		//require databse
		$this->db = new Database();
	}
}
