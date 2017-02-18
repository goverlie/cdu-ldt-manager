<?php
namespace core\libs;


class View {
	function __construct() {
		$this->theme = new Theme();
		$this->navigation = new Navigation();
	}
	
	public function render ($name) {
		require 'core/views/' . $name . '.php';
	}
	
	public function renderCoreModule ($module, $name = 'index') {
		require 'core/modules/' . $module . '/views/' . $name . '.php';
	}
}
