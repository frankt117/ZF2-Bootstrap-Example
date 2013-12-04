<?php
return array(
    'router' => array(
        'routes' => array(
            'tb-admin' => array(
                'priority' => 1000,
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
                    'category' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/category',
                            'defaults' => array(
                                '__NAMESPACE__' => 'TbAdmin\Controller',
                                'controller'    => 'Category',
                                'action'        => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/add',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'TbAdmin\Controller',
                                        'controller'    => 'Category',
                                        'action'        => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/edit',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'TbAdmin\Controller',
                                        'controller'    => 'Category',
                                        'action'        => 'edit',
                                    ),
                                ),
                            ),
                            'find' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/find',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'TbAdmin\Controller',
                                        'controller'    => 'Category',
                                        'action'        => 'find',
                                    ),
                                ),
                            ),
                            'complete' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/complete',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'TbAdmin\Controller',
                                        'controller'    => 'Category',
                                        'action'        => 'complete',
                                    ),
                                ),
                            )
                        )
                    ),
                    'product' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/product',
                            'defaults' => array(
                                '__NAMESPACE__' => 'TbAdmin\Controller',
                                'controller'    => 'Product',
                                'action'        => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/add',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'TbAdmin\Controller',
                                        'controller'    => 'Product',
                                        'action'        => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/edit',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'TbAdmin\Controller',
                                        'controller'    => 'Product',
                                        'action'        => 'edit',
                                    ),
                                ),
                            ),
                            'find' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/find',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'TbAdmin\Controller',
                                        'controller'    => 'Product',
                                        'action'        => 'find',
                                    ),
                                ),
                            ),
                            'complete' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/complete',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'TbAdmin\Controller',
                                        'controller'    => 'Product',
                                        'action'        => 'complete',
                                    ),
                                ),
                            )
                        )
                    )
                )
            )
        ),
    ),
);