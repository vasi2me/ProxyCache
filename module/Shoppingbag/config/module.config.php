<?php
return array (

		'schema' => array(
				'v2/shoppingbag' => './module/Shoppingbag/data/schema/share_request.json',
				'v3/shoppingbag/share_response' => './module/Shoppingbag/data/schema/share_response.json',
				
		),
		
		
		
		
		'router' => array(
				'routes' => array(
						/* 'shoppingbag' => array(
								'type' => 'segment',
								
								'options' => array(
										'route'       => '/v2/shoppingbag',
										'constraints' => array(
												'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id'         => '[a-zA-Z0-9_-]*'
										),
								),
						), */
						'shoppingbag' => array(
								'type'    => 'literal',
								'options' => array(
										'route'    => '/v2/shoppingbag',
										'defaults' => array(
												'controller' => 'shoppingbag',
												//'action'=> 'index',
										),
								),
								'may_terminate' => true,
								),
								),
				),
				
		'controllers' => array(
				'invokables' => array(
						'shoppingbag' => 'Shoppingbag\Controller\IndexController',
						
						
				),
		),

		'view_manager' => array(
				'strategies' => array('ViewJsonStrategy','ViewXmlStrategy',),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
				'xml_template_path_stack' => array(
						__DIR__ . '/../view',
						),
		),
);