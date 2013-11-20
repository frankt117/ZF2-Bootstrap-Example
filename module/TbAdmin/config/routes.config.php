<?php
return array(
    'router' => array(
        'routes' => array(
            'zfcuser' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/tb-admin/user',
                    'defaults' => array(
                        'controller' => 'zfcuser',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'login' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/login',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'login',
                            ),
                        ),
                    ),
                    'authenticate' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/authenticate',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'authenticate',
                            ),
                        ),
                    ),
                    'logout' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/logout',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'logout',
                            ),
                        ),
                    ),
                    'register' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/register',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'register',
                            ),
                        ),
                    ),
                    'changepassword' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/change-password',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'changepassword',
                            ),
                        ),                        
                    ),
                    'changeemail' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/change-email',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action' => 'changeemail',
                            ),
                        ),                        
                    ),
                ),
            ),
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
                    )
                )
            )
        ),
    ),
);