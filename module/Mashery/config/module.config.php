<?php


return array (

	
		
		
		
		'router' => array(
				'routes' => array(
						'Mashery' => array(
								'type' => 'segment',
								
								'options' => array(
										'route'       => '/v2/json-rpc[/:id]',
										'defaults' => array(
												'controller' => 'mashery',
												'id'         => '[a-zA-Z0-9_-]*'
										),
								),
						),
				),
		),
		'controllers' => array(
				'invokables' => array(
						'mashery' => 'Mashery\Controller\MasheryController',
				),
		),

		'view_manager' => array(
				'strategies' => array('ViewJsonStrategy'//'ViewXmlStrategy'
						),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
);