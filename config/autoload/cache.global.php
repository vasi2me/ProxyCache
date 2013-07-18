<?php
return array(
		'service_manager' => array(
				'factories' => array(
						'Zend\Cache\Storage\Filesystem' => function($sm){
							$cache = Zend\Cache\StorageFactory::factory(array(
									'adapter' => 'filesystem',
									'plugins' => array(
											'exception_handler' => array('throw_exceptions' => false),
											'serializer'
									)
							));
							$cache->setOptions(array(
									'cache_dir' => './data/listnerq'
							));
							return $cache;
						},
				),
				
				'alias' => array(
					'Cache\Storage' => 'Zend\Cache\Storage\Filesystem',	
				),		
				
		),
);