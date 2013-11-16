<?php
namespace Application;

return array(
    'view_manager' => array(
        'template_map' => array(
            'tb-admin/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'module_layouts' => array(
        'TbAdmin' => 'tb-admin/layout',
    ),
);
