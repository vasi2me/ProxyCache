<?php
namespace Akamai\Service;

use Zend\Di\ServiceLocatorInterface;

use Zend\ServiceManager\FactoryInterface;

class Database implements FactoryInterface {
	
	protected $serviceLocatory;
	protected $tableGateway;
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		$this->serviceLocatory = $serviceLocator;
	}
	
	
	
	

	/**
	 * @return Zend\Db\TableGateway;
	 */
	protected function getTableGateway(){
		return $this->serviceLocatory->get('Akamai\Processor\AkamaiTable');
	}
	
}