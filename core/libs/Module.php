<?php
namespace core\libs;


class Module {
	
	private $_model = null;
	
	/* Please use init  */
	function __construct () {
		$this->_model = new Model();
	}
	
	public  function init () {
		die("module");
	}
	
	public function getUserModules($user_id = NULL) {
		if (!empty($user_id)) {
			$userModules = array();
			$coreModules = $this->getCoreModules();
			$externalModules = $this->getExternalModules($user_id);
			$allModules = array_merge($coreModules,$externalModules);

			foreach ($allModules as $module) {
				//Get default settings
				$module['settings'] = $this->_model->db->select('
					SELECT module_setting_id, module_setting_name, module_setting_common_name, module_setting_default_value as module_setting_value
					FROM ' . DB_TABLE_PREFIX . 'module_settings
					WHERE module_id = ' . $module['module_id']
				);

				//Override default with user setting
				//This will only get user settings
				$userSettings = $this->_model->db->select('
					SELECT ums.module_setting_id, module_setting_name, module_setting_common_name, module_setting_value
					FROM ' . DB_TABLE_PREFIX . 'module_settings ms
					INNER JOIN ' . DB_TABLE_PREFIX . 'user_module_settings ums
					ON ms.module_setting_id = ums.module_setting_id
					WHERE ums.user_id = ' . $user_id . ' AND ums.module_setting_id = ms.module_setting_id AND ms.module_id = ' . $module['module_id']
				);
				//we are inside a single module
				foreach ($module['settings'] as $moduleSettings){
					//inside settings
						foreach ($userSettings as $userSetting) {
							//for each setting in user settings
							if ($moduleSettings['module_setting_id'] == $userSetting['module_setting_id']) {
								$moduleSettings['module_setting_value'] = $userSetting['module_setting_value'];
							}
							return print_r($moduleSettings,1);
						}
					}

				array_push($userModules,$module);
			}

			return $userModules;
		}
	}
	
	private function loadModuleSettings($module_id) {
		
	}
	
	public function getCoreModules() {
		return $this->_model->db->select('SELECT m.module_id, m.module_name, m.module_common_name, m.module_type
								FROM ' . DB_TABLE_PREFIX . 'modules m
								WHERE m.module_type = "core"');
	}
	
	public function getExternalModules($user_id = NULL) {
		if (empty($user_id)) {
				return false;
		}
		return $modules = $this->_model->db->select('SELECT m.module_id, m.module_name, m.module_common_name,  m.module_type
								FROM ' . DB_TABLE_PREFIX . 'modules m
								INNER JOIN ' . DB_TABLE_PREFIX . 'user_modules um
								ON um.module_id = m.module_id
								WHERE um.user_id = :user_id
								AND m.module_type = "external"',
								   	array(':user_id' => $user_id)
								  );
	}
	
	public function loadIntoSession () {
		
	
	}

}
