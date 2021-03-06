<?php
return array(
    'aliases' => array(
        'wdgblog_doctrine_em' => 'doctrine.entitymanager.orm_default',
    ),
    'invokables' => array(
        'wdgblog_service_blog' => 'WdgBlog\Service\Blog'
    ),
    'factories' => array(
        'wdgblog_repos_post' => function ($sm) {
            return $sm->get('doctrine.entity_manager.orm_default')->getRepository("WdgBlog\Entity\Post");
        },
        'wdgblog_repos_category' => function ($sm) {
            return $sm->get('doctrine.entity_manager.orm_default')->getRepository("WdgBlog\Entity\Category");
        },
    )
);