<?php

return array(
		'db' => array(
				'driver' => 'PDO',
				'dsn'            => 'mysql:dbname=sql313690;host=sql3.freesqldatabase.com',
				'username'       => 'sql313690',
				'password'       => 'jZ8%vA4%',
				'port'           => '3306', 
				'driver_options' => array(
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET time_zone = \'+0:00\'',
				),
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