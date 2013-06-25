<?php
return array (

		'schema' => array(
				'v3/order/supc' => './module/Order/data/schema/PUTSchema.json',
				
		),
		
		
		
		
		'router' => array(
				'routes' => array(
						'Order' => array(
								'type' => 'segment',
								
								'options' => array(
										'route'       => '/v3/order/:controller[/:id]',
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
						'supc' => 'Order\Controller\SingleUsePromoCodeController',
						
				),
		),

		'view_manager' => array(
				'strategies' => array('ViewJsonStrategy','ViewXmlStrategy'),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
);