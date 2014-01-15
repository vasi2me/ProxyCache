<?php
return array (

		'service_manager' => array(
				'aliases' => array(
						'Mock\Cache\Storage' => 'Zend\Cache\Storage\Filesystem',
				),
				'factories' => array(
						'Mock\Service\JsonValidator' => 'Mock\Service\JsonValidator',
		
				),
		),
		
);