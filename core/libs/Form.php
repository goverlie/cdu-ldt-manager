<?php
namespace core\libs;

/*
	- Fill out form
		- POST to PHP
		- Sanitize
		- Validate
		- Return Data
		- Write to Database
*/
require 'core/Form/Val.php';

class Form {
	
	/** @var array $_currentItem The immediately posted item*/
	private $_currentItem = null;
	
	/** @var array $_postData Stores the Posted Data*/
	private $_postData = array();
	
	/** @var object $_val The validator object*/
	private $_val = array();
	
	/** @var array $_error Holds the current forms errors*/
	private $_error = array();
		
	/**
	 * __construct - Instantiates the validator class
	 */
	public function __construct() {
		$this->_val = new Val();
	}
	
	/**
	 * post - This is to run $_POST
	 * @param array $field Field of the $_POST object
	 */
	public function post($field) {
		$this->_postData[$field] = $_POST[$field];
		$this->_currentItem = $field;
		return $this;
	}
	
	/**
	 * fetch - return the posted data
	 * @param  mixed $fieldName The name of the field
	 * @return mixed Returns a String or Array
	 */
	public function fetch($fieldName=null) {
		if ($fieldName) {
			if (isset($this->_postData[$fieldName])) {
				return $this->_postData[$fieldName];
			} else {
				return false;
			}
			return $this->_postData[$fieldName];
		} else {
			return $this->_postData;
		}
		
		
	}
	
	/**
	 * val - this is to validate the form
	 * @param  string $typeOfValidator A method from the Form/Val class
	 * @param  string [$arg            = null]    A property to validate against
	 * @return string Returns validated string
	 */
	public function val($typeOfValidator, $arg = null) {
		if ($arg == null) {
			$error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem]);
		} else {
			$error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem], $arg);
		}
		
		if($error) {
			$this->_error[$this->_currentItem] = $error;
		}
		
		return $this;
	}
	
	public function submit() {
		if (empty($this->_error)) {
			return true;
		} else {
			$str = '';
			foreach ($this->_error as $key => $value) {
				$str .= $key . '=>' . $value . "<br />";
			}
			throw new Exception($str);
		}
	}
}
