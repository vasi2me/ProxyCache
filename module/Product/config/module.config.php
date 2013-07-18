<?php
return array (

		'schema' => array(
				'v3/catalog/product' => './module/Order/data/schema/PUTSchema.json',
				
		),
		
		
		
		
		'router' => array(
				'routes' => array(
					'v4product' => array(
								'type'    => 'segment',
								'options' => array(
										'route'    => '/v4/catalog/product[/:id][([:options])]',
										'defaults' => array(
												'controller' => 'v4product',
												//'action'=> 'index',
										),
										'constraints' => array(
												'id'         => '[a-zA-Z0-9_-]*'
										),
								),
								'may_terminate' => true,
							/*'child_routes' => array(
									// Segment route for viewing one blog post
									'manufacturer' => array(
											'type' => 'segment',
											'options' => array(
													'route' => '([:manufacturer])',
													'constraints' => array(
															'manufacturer' => '[a-zA-Z0-9_-]+'
													),
													'defaults' => array(
															'action' => 'manufacturer'
													)
											),
											),
									),
								*/	
							
						),
						'v3product' => array(
								'type'    => 'segment',
								'options' => array(
										'route'    => '/v3/catalog/product[/:id]',
										'defaults' => array(
												'controller' => 'v3product',
												//'action'=> 'index',
										),
										'constraints' => array(
												'id'         => '[a-zA-Z0-9_-]*'
										),
								),
								'may_terminate' => true,
						),
						
				),
		),
		'controllers' => array(
				'invokables' => array(
						'v3product' => 'Product\Controller\V3ProductController',
						'v4product' => 'Product\Controller\V4ProductController',
						
				),
		),
		
		
		'service_manager' => array(
				
				'aliases' => array(
						
						'V4Product\Badge' => 'V4Product\Badges',
						'V4Product\Upc' => 'V4Product\Upcs',
						
						),
		
				'factories' => array(
		
						'V4Product\Assembler' => 'Product\Service\Assembler',
						// 'V4Product\GenericFactory' => 'Product\Schema\GenericFactory',
						
						'V4Product\AdditionalImages' => 'Product\Schema\AdditionalImages',
						'V4Product\Attributes' => 'Product\Schema\Attributes',
						'V4Product\Availability' => 'Product\Schema\Availability',
						'V4Product\Badges' => 'Product\Schema\Badges',
						'V4Product\Brand' => 'Product\Schema\Brand',
						'V4Product\ColorMap' => 'Product\Schema\ColorMap',
						'V4Product\Corpclass' => 'Product\Schema\Corpclass',
						'V4Product\DomainValuesMap' => 'Product\Schema\DomainValuesMap',
						'V4Product\Error' => 'Product\Schema\Error', // cammpt ne ised
						'V4Product\Price' => 'Product\Schema\Price',
						'V4Product\PrimaryImage' => 'Product\Schema\PrimaryImage',
						'V4Product\ProductCategory' => 'Product\Schema\ProductCategory',
						'V4Product\Promotions' => 'Product\Schema\Promotions',
						'V4Product\Rebates' => 'Product\Schema\Rebates',
						'V4Product\RecommendedProducts' => 'Product\Schema\RecommendedProducts',
						'V4Product\Reviews' => 'Product\Schema\Reviews',
						'V4Product\Shipping' => 'Product\Schema\Shipping',
						'V4Product\SizeMap' => 'Product\Schema\SizeMap',
						'V4Product\Summary' => 'Product\Schema\Summary',
						'V4Product\Upcs' => 'Product\Schema\Upcs',
						'V4Product\Urlmetadata'=> 'Product\Schema\Urlmetadata',
						),
				),
				

		'view_manager' => array(
				'strategies' => array('ViewJsonStrategy','ViewXmlStrategy'),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
);