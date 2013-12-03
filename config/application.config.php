<?php
return array(
    'modules' => array(
	'DoctrineModule',
	'DoctrineORMModule',
        'ZendDeveloperTools',
	'EdpModuleLayouts',
        'ZfcBase',
        'ZfcUser',
        'ZfcUserDoctrineORM',
        //'BjyAuthorize', // Need to figure out why this invalidates user on non /tb-admin side.
        'PtgBase',
        'PtgContact',
        'PtgLead',
        //'PtgUser',
        'PtgTbCategory',
	'Application',
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
