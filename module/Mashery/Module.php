<?php
namespace Mashery;

use Zend\Mvc\MvcEvent;
use Zend\Log\LoggerAwareInterface;


class Module  {

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig()
	{
		return array(
				'Zend\Loader\StandardAutoloader' => array(
						'namespaces' => array(
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
						),
				),
		);
	}

	/*
	 * All the Services under this module can implement
	 * LoggerAwareInterface and Logger will be enabled for all of them
	 */
	public function getServiceConfig()
	{
		return array(
				'initializers' => array(
						'logger' => function($service, $sm) {
							if ($service instanceof LoggerAwareInterface) {
								$logger = $sm->get('Zend\Log');
								$service->setLogger($logger);
							}
						}
				),
		);
	}
}