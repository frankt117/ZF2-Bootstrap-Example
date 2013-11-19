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
            'tb-admin-category' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/tb-admin/category',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TbAdmin\Controller',
                        'controller'    => 'Category',
                        'action'        => 'index',
                    ),
                ),
            ),
            'tb-admin-category-add' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/tb-admin/category/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TbAdmin\Controller',
                        'controller'    => 'Category',
                        'action'        => 'add',
                    ),
                ),
            ),
            'tb-admin-category-edit' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/tb-admin/category/edit',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TbAdmin\Controller',
                        'controller'    => 'Category',
                        'action'        => 'edit',
                    ),
                ),
            )
        ),
    ),
);