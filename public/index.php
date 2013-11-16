<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

//For ZendDeveloperTools
define('REQUEST_MICROTIME', microtime(true));
define('APPLICATION_ROOT', __DIR__);

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();