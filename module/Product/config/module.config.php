<?php
return array (

		'schema' => array(
				'v3/catalog/product' => './module/Order/data/schema/PUTSchema.json',
				
		),
		
		
		
		
		'router' => array(
				'routes' => array(
						'Order' => array(
								'type' => 'segment',
								
								'options' => array(
										'route'       => '/v3/catalog/product/:id',
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
						'product' => 'Product\Controller\V3ProductController',
						
				),
		),

		'view_manager' => array(
				'strategies' => array('ViewJsonStrategy','ViewXmlStrategy'),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
);