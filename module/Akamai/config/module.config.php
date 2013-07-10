<?php
return array (

		
		
		
		
		
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
				),
		),
		'controllers' => array(
				'invokables' => array(
						//'supc' => 'Order\Controller\SupcController',
						'akamaiserver' => 'Akamai\Controller\ServerController',
						
				),
		),

		'view_manager' => array(
				'strategies' => array('ViewJsonStrategy','ViewXmlStrategy'),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
);