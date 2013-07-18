<?php
namespace Product\Service;



use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Product\Schema\Summary;
use Product\Schema\Upcs;
use Product\Schema\Shipping;

class Assembler implements FactoryInterface {
	
	
	protected $servicelocator;
	protected $response = array();
	
	public function parseOptions($options=array()){
		
		$options = explode(',', $options);
		
		
		if(is_array($options)){
			foreach ($options as $group){
				$groupResp = null; //print_r($group); exit;
				if($this->getServiceLocator()->has('V4Product\\' . ucfirst($group))) {
					$groupResp = $this->getServiceLocator()->get('V4Product\\' . ucfirst($group));
					
					$this->response = (object) array_merge((array)$this->response,(array) $groupResp);
				}
				
			}
			$y = $this->objectToArray($this->response);
		}
		// we have a unnecessary property servicelocator in GenericFactory 
		// Hence removing it by unsetting it;
		unset($y["servicelocator"]);
		$this->response = $y;
	}
	
	public function getResponse(){
		return $this->response;
	}
	
	
	
	
	
	protected   function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
	
		if (is_array($d)) {
			/*
			 * Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(array(__CLASS__,__FUNCTION__), $d);
		}
		else {
			// Return array
			return $d;
		}
	}
	
	public function createService(ServiceLocatorInterface $serviceLocator) {
		$this->servicelocator = $serviceLocator;
		return $this;
	}
	
	/**
	 * @return \Zend\ServiceManager\ServiceLocatorInterface
	 */
	public function getServiceLocator(){
		return $this->servicelocator;
	}
	
	public function setServiceLocator($sl) {
		$this->servicelocator = $sl;
		return $this;
	}
}