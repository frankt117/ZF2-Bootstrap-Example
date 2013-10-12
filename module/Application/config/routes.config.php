<?php
return array(
    'router' => array(
        'routes' => array(
            'app_test_type' => array(
                'type' => 'Literal',
		'options' => array(
		    'route' => '/',
		    'defaults' => array(
			'__NAMESPACE__' => 'Application\Controller',
			'controller'    => 'Application\Controller\Index',
			'action'        => 'Index',
		    ),
		),
                'may_terminate' => true
            ), 
        ),
    ),
);