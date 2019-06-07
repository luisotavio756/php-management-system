<?php  
	// Load config
	require_once 'config/config.php';

	// Load helpers
	require_once 'helpers/url-helper.php';
	require_once 'helpers/session-helper.php';

	// Load libraries
	// require_once 'libraries/Core.php';
	// require_once 'libraries/Database.php';
	// require_once 'libraries/Controller.php';

	// Autoload Libraries
	spl_autoload_register(function($className){
		require_once 'libraries/'. $className .'.php';
	});

?>