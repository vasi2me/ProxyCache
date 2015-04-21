<?php
namespace Application\Service;



use Zend\Filter\File\UpperCase;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Recording implements FactoryInterface
{
	protected $servicelocator;


	private $_queryParams;
	private $_endpoint;
	private $_body;
	private $_httpmethod;
	private $_headers;
	private $_cookies;
	private $_incommingRequest;
	private $_reqStatus = false;
	private $_dbMessages = array();

	public function setRequest($request=null, $postData=null){
		$this->_incommingRequest = $request;
		$this->_body = $postData;

		$this->getHeaders();
		$this->getQuery();
		$this->process();
		//print_r($this->_endpoint);
		//print_r($this->_queryParams);
		// exit;
	}


	public function process(){
		if(is_array($this->_body) || is_object($this->_body)){
			$db = $this->getServiceLocator()->get('Application\Service\Database');
			$db->saveToDb($this->_endpoint, $this->_body,$this->_httpmethod,$this->_responseCode,$useMock = true, $this->_queryParams, $headers=null, $cookies=null);
			$this->_reqStatus = true;
			$this->_dbMessages = $db->getMessages();
		}
		else {
			$this->_reqStatus = false;
		}
	}
	
	public function delete(){
		
	}

	public function getBody(){
		//return array("success"=> $this->_reqStatus);
		$d["success"] = $this->_reqStatus;
		$d["messages"] = $this->_dbMessages;
		return $d;
	}

	protected function getHeaders(){
		$this->_headers = $this->_incommingRequest->getHeaders();
	}

	public function getStatusCode(){
		if($this->_reqStatus)
		return 201;
		return 400;
	}

	protected function getQuery(){
		$queryParams = $this->_incommingRequest->getQuery();
		$this->_endpoint = $queryParams['path'];
		if(isset($queryParams['queryparams']))
			$this->_queryParams = $queryParams['queryparams'];
		else if (isset($queryParams['query']))
			$this->_queryParams = $queryParams['query'];
		else 
			$this->_queryParams = "";
		
		$this->_responseCode = $queryParams['code'];
		if(!$this->_responseCode)
			$this->_responseCode = 200;
		$this->_httpmethod = strtoupper($queryParams['method']);
		if(!$this->_httpmethod)
			$this->_httpmethod = 'GET';
			
		if($this->_endpoint){
			return true;
		}
		return false;
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