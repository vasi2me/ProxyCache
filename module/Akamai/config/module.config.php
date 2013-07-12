<?php


return array (

		'service_manager' => array(
		'factories' => array(
				'Akamai\Processor\AkamaiTable' =>  function($sm) {
					$tableGateway = $sm->get('AkamaiTableGateway');
					$table = new \Akamai\Processor\AkamaiTable($tableGateway);
					return $table;
				},
				'AkamaiTableGateway' => function ($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter');
					$hydrator = new \Akamai\Processor\AkamaiHydrator(
							array(
									'id'=>'id',
									'sessionId'=>'sessionId',
									'resultCode'=>'resultCode',
									'uri'=>'uri',
									'opt'=>'opt',
									'additional'=>'additional',
									'created'=>'created'
						));
					$rowObjectPrototype = new \Akamai\Processor\AkamaiModel();
					$resultSet = new \Zend\Db\ResultSet\HydratingResultSet(
							$hydrator, $rowObjectPrototype
					);
					return new \Zend\Db\TableGateway\TableGateway(
							'akamai', $dbAdapter, null, $resultSet
					);
				}
				
		),
		),
		
		
		
		'router' => array(
				'routes' => array(
						'Akamai' => array(
								'type' => 'literal',
								
								'options' => array(
										'route'       => '/soap/servlet/soap/purge',
										'defaults' => array(
												'controller' => 'akamaiserver',
												'action'=> 'index',
										),
								),
						),
						'akamaiui' => array(
								'type' => 'segment',
								'options' => array(
										'route' => '/akamai[/:action]',
										'constraints' => array(
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
										),
										'defaults' => array(
												'controller' => 'verify',
												'action' => 'index',
										),
								),
						),
				),
		),
		'controllers' => array(
				'invokables' => array(
						//'supc' => 'Order\Controller\SupcController',
						'akamaiserver' => 'Akamai\Controller\ServerController',
						'verify'=> 'Akamai\Controller\VerifyController',
				),
		),

		'view_manager' => array(
				//'strategies' => array('ViewJsonStrategy','ViewXmlStrategy'),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
);