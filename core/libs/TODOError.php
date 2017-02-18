<?php
namespace core\libs;

class Error {
	
	private $_controller = null;

	function __construct () {}
	
	public function showError () {
		require
		$className = 'error.php';
		$this->_controller = $
		$path = 'core/modules/error/'.$modelPath . $name . '_model.php';
		if (file_exists($path)) {
			require $path;
			
			$this->model = new $modelName();
		}
	}
}
