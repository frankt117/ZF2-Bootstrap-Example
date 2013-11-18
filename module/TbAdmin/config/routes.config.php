<?php
return array(
    'router' => array(
        'routes' => array(
            'tb-admin' => array(
                'type' => 'Literal',
                    'options' => array(
                        'route' => '/tb-admin',
                        'defaults' => array(
                        '__NAMESPACE__' => 'TbAdmin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                        ),
                    ),
                'may_terminate' => true,
                'child_routes' => array(
//		    'zfcuser' => array(
//			'type' => 'Literal',
//			'priority' => 1,
//			'options' => array(
//			    'route' => '/user',
//			    'defaults' => array(
//				'__NAMESPACE__' => 'Weblab\Controller',
//				'controller' => 'User',
//				'action'     => 'index',
//			    ),
//			),
//                    )
                )
            ),
            'update' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/tb-admin/update',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TbAdmin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'update',
                    ),
                ),
            ),
        ),
    ),
);