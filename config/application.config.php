<?php
return array(
    'modules' => array(
        'PtgBase',
        'PtgContact',
        'PtgLead',
	'Application',
        'TbAdmin',
	'DoctrineModule',
	'DoctrineORMModule',
        'ZendDeveloperTools',
	'EdpModuleLayouts',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor'
            ),
        'config_glob_paths' => array('config/autoload/{,*.}{global,local}.php')
    )
);
