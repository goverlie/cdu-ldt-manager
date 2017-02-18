<?php
namespace core\libs;


class Fortis {
	
	private $_url = null;
	private $_controller = null;
	
	private $_coreModulePath = 'core/modules/';
	private $_externalModulePath = 'external/modules/';
	private $_modules = null;
	private $_loadedModules = null;
	
	private $_controllerPath = 'controller/'; // Always include trailing slash
	private $_modelPath = 'model/'; // Always include trailing slash
	private $_errorFile = 'bad.php';
	private $_defaultFile = 'index.php';
		
	/**
	 * __construct - not used, please use init()
	 *
	 * @return boolean
	 */
	function __construct () {}
	
	/**
	 * Start the App
	 * @return boolean
	 */
	public function init() {
		//Sets the protected url
		$this->_getUrl();
		Session::init();
		$this->_loadModules();
		

		// Load the default controller if no URL is set
		// no url is provided outside of the base
		if (empty($this->_url[0])) {
			$this->_loadDefaultController();
			return false;
		}
		
		$this->_loadExistingController();
		$this->_callControllerMethod();
	}
	
	private function _loadModules () {
		$this->_modules = new Module();
		$this->_modules->loadIntoSession();
	}
	
	/**
	 * (Optional) Set a custom path to controllers
	 * @param string $path
	 */
	public function setControllerPath ($path) {
		$this->_controllerPath = trim($path, '/') . '/';
	}
	
	/**
	 * (Optional) Set a custom path to models
	 * @param string $path
	 */
	
	public function setModelPath ($path) {
		$this->_modelPath = trim($path, '/') . '/';
	}
	
	/**
	 * (Optional) Set a custom path to error file; use the file name only of your error file
	 * @param string $path
	 */
	public function setErrorFile ($path) {
		$this->_errorFile = trim($path, '/');
	}
	/**
	 * (Optional) Set a custom path to default file; use the file name only of your default file
	 * @param string $path
	 */
	public function setDefaultFile($path) {
		$this->_defaultFile = trim($path, '/');
	}
	
	/**
	 *  _getURL - Fetches the $_GET of the URL assigns to private array
	 */
	private function _getUrl() {
		$this->_url = (isset($_GET['url']) ? $_GET['url'] : null);
		$this->_url = rtrim($this->_url, "/");
		$this->_url = filter_var($this->_url, FILTER_SANITIZE_URL);
		$this->_url = explode ('/',$this->_url);
	}
	
	/**
	 * _loadDefaultController - Loads the default controller if no $_GET is passed
	 */
	private function _loadDefaultController() {
		// load index module
		require $this->_coreModulePath . 'index/' .  $this->_controllerPath . $this->_defaultFile;
		$className = ucfirst(basename($this->_defaultFile,'.php'));
		$this->_controller = new $className();
		$this->_controller->index();
	}
	
	/**
	 * _loadExistingController - Load an existing controller if there IS a $_GET parameter passed
	 * @return boolean|string
	 */
	private function _loadExistingController() {
		//$this->_url[0] is current module
		$currentModule = 'core/modules/' . $this->_url[0] . '/';
		
		$file =  $currentModule . $this->_controllerPath . $this->_url[0]. '.php';
				//die("loading existing controller " . $file);

		if (file_exists($file)) {
			require $file;
			//Automatic Model Loader
			$this->_controller = new $this->_url[0];
			$this->_controller->loadModel($this->_url[0], $this->_modelPath);
		} else {
			$this->_error();
			return false;
		}
	}
	
	/**
	 * _callControllerMethod - If a method is passed, run it
	 *
	 *	http://localhost/controller/method/(param)/(param)/(param)
	 *	url[0] = Controller
	 *	url[1] = Method
	 *	url[2] = Param
	 *	url[3] = Param
	 *	url[4] = Param
	 *
	 */
	private function _callControllerMethod() {
		
		$length = count($this->_url);
		
		// Make sure the method we are calling exists
		if ($length > 1){
			if (!method_exists($this->_controller, $this->_url[1])) {
				$this->_error();
			}
		}
		
		switch ($length) {
			case 5:
				//Controller->Method(Param1, Param2, Param3)
				$this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
				break;
			
			case 4:
				//Controller->Method(Param1, Param2)
				$this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
				break;
			
			case 3:
				//Controller->Method(Param1, Param2)
				$this->_controller->{$this->_url[1]}($this->_url[2]);
				break;
			
			case 2:
				//Controller->Method(Param1, Param2)
				$this->_controller->{$this->_url[1]}();
				break;
			
			default:
				$this->_controller->index();
				break;
		}
	}
	
	
	
	/**
	 * _error - display an error page if nothing exists
	 * @return boolean
	 */
	private function _error () {
		require $this->_coreModulePath . 'bad/' .  $this->_controllerPath . $this->_errorFile;
		$className = ucfirst(basename($this->_errorFile,'.php'));
		
		$this->_controller = new $className();
		$this->_controller->index();
		exit;
	}
}
