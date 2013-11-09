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
            'thanks' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/thanks',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Thanks',
                        'action'        => 'index',
                    ),
                ),
            ),
            'affiliate' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/affiliate',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Affiliate',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
);