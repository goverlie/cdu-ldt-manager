#This is a nice thing

```
1.  Style or create a theme/template for a site that can be totally custom if need be;
2.  Use a file system/structure that simplifies the updating process (i.e. PHP based); and
3.  Allow a user a very basic admin area, or just the ability to log in somehow
	and just edit content (i.e. only text/images, maybe a gallery, not sure)
```


##Modules
	- Modules are loaded Fortis-_loadModules
	- Module load controlled through user_modules tables
	- Each module has settings in module_settings
	- Each user has value of setting in user_module_settings
	- Two types of modules: core and external

	
##Themes
	- Theme Class loaded on View
	- Theme table has -> theme_id, name, common_name, link
	- Default theme is hardcoded to id 1


##TODO:
	- Core modules should load when app loads
	- Session set should see if key is array
	- External modules should load when user logs in
	- Trigger on db for settings to copy from default to user upon update of default settings/new module settings
	- THEMES needs work -> currently set to jquerythemes?
	- Views render hard coded to core folder
	- load js in header.php and in controller are hardcoded
	- add module name to class name of container
	- Theme saves on page load (Performance problem)
	- Clean up select statements particularly in the WHERE and Bind


##Continue:
	- Theme doesn't need to be in session, NEED TO REMOVE
	- ??Every module should be an extension of Module
	- ??Module should load the controller/model
	- DATABASE - load default values for user if dont exist in user settings
	- Check Module/navigation functions for private/public
	- Array for settings being duplicated settings for each module
	- WORKING ON MODULE.php
	- Settings should have own class
	- Settings should only load/save based on module loaded
