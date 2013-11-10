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
            'carports' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/carports',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Carports',
                        'action'        => 'index',
                    ),
                ),
            ),
            'garages' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/garages',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Garages',
                        'action'        => 'index',
                    ),
                ),
            ),
            'buildings' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/buildings',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Buildings',
                        'action'        => 'index',
                    ),
                ),
            ),
            'contact' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/contact',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Contact',
                        'action'        => 'index',
                    ),
                ),
            ),
            'get-started' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/get-started',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'GetStarted',
                        'action'        => 'index',
                    ),
                ),
            ),
            'estimate' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/get-started/estimate',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'GetStarted',
                        'action'        => 'estimate',
                    ),
                ),
            ),
        ),
    ),
);