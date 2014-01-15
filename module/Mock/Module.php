<?php
namespace Mock;
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
	
	/**
	 * Initalize logger for Restful Controller so, that 
	 * Logger can be used in extended controllers
	 * @return multitype:multitype:NULL
	 */
	public function getControllerConfig()
	{
		return array(
				'initializers' => array(
						'logger' => function($instance, $sm) {
							if ($instance instanceof LoggerAwareInterface) {
								$logger = $sm->getServiceLocator()->get('Zend\Log');
								$instance->setLogger($logger);
							}
						},
				),
		);
	}
	
}