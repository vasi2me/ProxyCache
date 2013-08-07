<?php
namespace Mashery;

use Zend\Mvc\MvcEvent;


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
	
	public function onBootstrap(MvcEvent $e) {
		$eventManager = $e->getApplication()->getEventManager();
		//$eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'acceptTypePreDispatch'),1);
	}
	
	public function acceptTypePreDispatch($event) {
		//$response = $event->getResponse();
		
        
        
        //$response->sendHeaders();
        //exit;
	}
	
}