<?php

return array(
		'db' => array(
				'driver' => 'PDO_SQLite',
				'database' => './data/sqlite/sqlite.db',
		),

		'service_manager' => array (
				'factories' => array(
						'Zend\Db\Adapter' => function($sm){
							$config = $sm->get('config');
							$dbAdapter = new Zend\Db\Adapter\Adapter($config['db']);
							return $dbAdapter;
						},
				),
		),

);