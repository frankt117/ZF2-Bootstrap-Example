<?php
namespace PtgContact;

return array(
    'doctrine' => array(
	'driver' => array(
	     __NAMESPACE__ . '_driver' => array(
                 'class' => 'PtgBase\Doctrine\AnnotationDriver',
                 'cache' => 'array',
                 'paths' => array(__DIR__ . '/../src/'.__NAMESPACE__.'/Entity')
	     ),
             'orm_default' => array(
                 'drivers' => array(
                      __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                 )
             )
	)
    )
);
