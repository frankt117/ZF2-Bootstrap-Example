<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'literal',
		'options' => array(
		    'route' => '/',
		    'defaults' => array(
			'__NAMESPACE__' => 'Application\Controller',
			'controller'    => 'Index',
			'action'        => 'index',
		    ),
		),
            ),
        ),
    ),
);