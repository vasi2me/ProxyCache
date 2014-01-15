<?php


namespace Proxy\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class SgProxy implements FactoryInterface {
	
	protected $serviceLocatory;
	
	
	public function __construct($uri, $options) {
		
		
		
	}
	
	
	
	
	
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		$this->serviceLocatory = $serviceLocator;
	}
	
	
	
}