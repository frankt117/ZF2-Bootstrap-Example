<?php

define('ENV_PROD', 'production');
define('ENV_DEV', 'development');
define('APP_ENV', getenv('APP_ENV') === ENV_DEV ? ENV_DEV : ENV_PROD);

if(APP_ENV == ENV_PROD)
{
    ini_set("display_errors", "Off");
    ini_set("display_startup_errors", "Off");
    
    $error_log = ini_get('error_log');
    
    if(strlen($error_log))
    {
        ini_set("log_errors", "On");
        ini_set("error_reporting", "E_ALL");
    }
}

return array(
    'modules' => array(
	'DoctrineModule',
	'DoctrineORMModule',
        'ZendDeveloperTools',
	'EdpModuleLayouts',
        'ZfcBase',
        'ZfcUser',
        'ZfcUserDoctrineORM',
        'BjyAuthorize',
        'PtgBase',
        'PtgContact',
        'PtgLead',
        'PtgUser',
        'PtgTbCategory',
        'PtgTbProduct',
	'Application',
        'WdgBlog',
        'TbAdmin',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor'
            ),
        'config_glob_paths' => array('config/autoload/{,*.}{global,local}.php')
    )
);
