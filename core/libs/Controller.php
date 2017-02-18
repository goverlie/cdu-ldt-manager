<?php
namespace core\libs;

class Controller {
	function __construct () {
		$this->view = new View();
	}
	
	/**
	 * loadModel - Loads the model associated with the Controller
	 * @param string $name Name of the Model
	 * @param string $path Location of the models
	 */
	public function loadModel ($name, $modelPath = 'model/') {
		$path = 'core/modules/'.$name.'/'.$modelPath . $name . '_model.php';
		if (file_exists($path)) {
			require $path;
			
			$modelName = $name . '_Model';
			$this->model = new $modelName();
		}
	}
}
