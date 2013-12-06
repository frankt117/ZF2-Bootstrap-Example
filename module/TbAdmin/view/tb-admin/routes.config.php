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
                    ),
                    'blog' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/blog',
                            'defaults' => array(
                                '__NAMESPACE__' => 'TbAdmin\Controller',
                                'controller'    => 'Blog',
                                'action'        => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'post_list' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/blog/post/list[/:page]',
                                    'defaults' => array(
                                        'controller' => 'TbAdmin\Controller\BlogPost',
                                        'action' => 'list',
                                        'page' => '1'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'post_add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/blog/post/add',
                                    'defaults' => array(
                                        'controller' => 'TbAdmin\Controller\BlogPost',
                                        'action' => 'add'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'post_show' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/blog/post/show[/:id]',
                                    'defaults' => array(
                                        'controller' => 'TbAdmin\Controller\BlogPost',
                                        'action' => 'show'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'post_delete' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/blog/post/delete[/:id]',
                                    'defaults' => array(
                                        'controller' => 'TbAdmin\Controller\BlogPost',
                                        'action' => 'delete'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'post_edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/blog/post/edit[/:id]',
                                    'defaults' => array(
                                        'controller' => 'TbAdmin\Controller\BlogPost',
                                        'action' => 'edit'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'post_category' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/blog/post/category[/:id]',
                                    'defaults' => array(
                                        'controller' => 'TbAdmin\Controller\BlogPost',
                                        'action' => 'category'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'category_list' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/blog/category/list',
                                    'defaults' => array(
                                        'controller' => 'TbAdmin\Controller\BlogCategory',
                                        'action' => 'list'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'category_add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/blog/category/add',
                                    'defaults' => array(
                                        'controller' => 'TbAdmin\Controller\BlogCategory',
                                        'action' => 'add'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'category_show' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/blog/category/show[/:id]',
                                    'defaults' => array(
                                        'controller' => 'TbAdmin\Controller\BlogCategory',
                                        'action' => 'show'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'category_delete' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/blog/category/delete[/:id]',
                                    'defaults' => array(
                                        'controller' => 'TbAdmin\Controller\BlogCategory',
                                        'action' => 'delete'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'category_edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/blog/category/edit[/:id]',
                                    'defaults' => array(
                                        'controller' => 'TbAdmin\Controller\BlogCategory',
                                        'action' => 'edit'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                        )
                    )
                )
            )
        ),
    ),
);