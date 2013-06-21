<?php

return array(

		'navigation' => array(
				// The DefaultNavigationFactory we configured in (1) uses 'default' as the sitemap key
				'default' => array(
						// And finally, here is where we define our page hierarchy

				),
		),

		'view_manager' => array(
				'display_not_found_reason' => true,
				'display_exceptions'       => true,
				'doctype'                  => 'HTML5',
				'not_found_template'       => 'error/404',
				'exception_template'       => 'error/index',
				'template_map' => array(
						'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
						'error/404'               => __DIR__ . '/../view/error/404.phtml',
						'error/index'             => __DIR__ . '/../view/error/index.phtml',
				),
				//'template_path_stack' => array(
				//		__DIR__ . '/../view',
				//),
		),
);
