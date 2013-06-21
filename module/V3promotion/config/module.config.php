<?php
return array (

		'schema' => array(
				'v3/promotions/share_request' => './module/V3promotion/data/schema/share_request.json',
				'v3/promotions/share_response' => './module/V3promotion/data/schema/share_response.json',
				
		),
		
		'default_data' => array (
				'v3/promotions/share_response' => './module/V3promotion/data/default/share_response.json',
				'v3/promotions/share_error_response' => './module/V3promotion/data/default/share_error_response.json',
				),
		
		
		'router' => array(
				'routes' => array(
						'v3promotions' => array(
								'type' => 'segment',
								
								'options' => array(
										'route'       => '/v3/promotions/:controller[/:id]',
										'constraints' => array(
												'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id'         => '[a-zA-Z0-9_-]*'
										),
								),
						),
				),
		),
		'controllers' => array(
				'invokables' => array(
						'sorted' => 'V3promotion\Controller\SortedController',
						'share' => 'V3promotion\Controller\ShareController',
						
				),
		),

		'view_manager' => array(
				'strategies' => array('ViewJsonStrategy',),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
);