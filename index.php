<?php
/*header('Location: https://' . $_SERVER['SERVER_NAME'] . '/manage');
exit;*/
define('VERSION', '4.1.0.3');

// Configuration
if (is_file('config.php')) {
	require_once('config.php');
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');

// Framework
require_once(DIR_SYSTEM . 'framework.php');
