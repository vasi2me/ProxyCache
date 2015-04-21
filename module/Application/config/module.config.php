<?php
return array (

		'navigation' => array(
				// The DefaultNavigationFactory we configured in (1) uses 'default' as the sitemap key
				'default' => array(
						// And finally, here is where we define our page hierarchy

				),
		),

		'router' => array(
				'routes' => array(
						'get' => array(
								'type'    => 'method',
								'options' => array(
										'verb'    => 'get',
										'defaults' => array(
												'controller' => 'getController',
												//'action'=> 'index',
										),
								),
								'may_terminate' => true,
						),
	//TODO fix the /config POST and v4/recording post both will not work
						'post' => array(
								'type'    => 'method',
								'options' => array(
										'verb'    => 'post,put,delete,patch',
										'defaults' => array(
												'controller' => 'postController',
												//'action'=> 'index',
										),
								),
								'may_terminate' => true,
						),
						'config' => array(
								'type' => 'segment',
								'options' => array(
										'route' => '/config[/:action][/:id]',
										'constraints' => array(
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id' => '[0-9]+',
										),
										'defaults' => array(
												'controller' => 'indexController',
												'action' => 'index',
										),
								),
						),
						
						'recording' => array(
								'type' => 'segment',
								'options' => array(
										'route' => '/v4/recording[/:id]',
										'constraints' => array(
												'id' => '[0-9]+',
										),
										'defaults' => array(
												'controller' => 'recordController',
										),
								),
						),
				),
		),

		'controllers' => array(
				'invokables' => array(
						'getController' => 'Application\Controller\GetController',
						'indexController' => 'Application\Controller\IndexController',
						'recordController' => 'Application\Controller\RecordController',
						'postController' => 'Application\Controller\PostController',

				),
		),


		'view_manager' => array(
				'strategies' => array('ViewXmlStrategy','ViewJsonStrategy'),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),


		'service_manager' => array(

				'aliases' => array(
						'Application\Db\Adapter' => 'Zend\Db\Adapter',
				),

				'factories' => array(
						'Application\Http\Proxy' => 'Application\Http\Proxy',
						'Application\Http\Client' => 'Application\Http\Client',
						'Application\Service\Recording' => 'Application\Service\Recording',
						'Application\Service\Database' => 'Application\Service\Database',

						'Application\Hydrator\Generic' => function($sm){
							$hydrator = new \Application\Database\Mapper\GenericHydrator();
							return $hydrator;
						},

						'Database\Uris' => function($sm){
							$entity = new \Application\Database\Entity\Uris();
							$mapper = new \Application\Database\Mapper\Uris();
							$mapper->setEntityPrototype($entity);
							$mapper->setDbAdapter($sm->get('Application\Db\Adapter'));
							$mapper->setHydrator($sm->get('Application\Hydrator\Generic'));
							return $mapper;
						},
						
						'Database\Configs' => function($sm){
							$entity = new \Application\Database\Entity\Configs();
							$mapper = new \Application\Database\Mapper\Configs();
							$mapper->setEntityPrototype($entity);
							$mapper->setDbAdapter($sm->get('Application\Db\Adapter'));
							$mapper->setHydrator($sm->get('Application\Hydrator\Generic'));
							return $mapper;
						},
						
						'Database\Responses' => function($sm){
							$entity = new \Application\Database\Entity\Responses();
							$mapper = new \Application\Database\Mapper\Responses();
							$mapper->setEntityPrototype($entity);
							$mapper->setDbAdapter($sm->get('Application\Db\Adapter'));
							$mapper->setHydrator($sm->get('Application\Hydrator\Generic'));
							return $mapper;
						},
				),

		),

);