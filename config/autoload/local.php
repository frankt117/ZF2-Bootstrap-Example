<?php

return array(
	'doctrine' => array(
		'connection' => array (
			'orm_default' => array(
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host' => 'localhost',
					'port' => '3306',
					'user' => 'turtle_data',
					'password' => 'B1GThursty',
					'dbname' => 'turtlebuilt'
				)
			)
		)
	)
);
