<?php
namespace Application\Http;



use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


use Zend\Http\Client as HttpClient;

class Client implements FactoryInterface
{
	protected $servicelocator;

	private $_remoteHost;
	
	private $_body = null;
	private $_statusCode = 500;
	
	public function remoteRequest($path, $query)
	{
		try {
		$this->getRemoteHost();
		$reqStatus = false;
		$client = new HttpClient();
		$client->setAdapter('Zend\Http\Client\Adapter\Curl');
		
		//$fullUri = $this->_remoteHost . $path . '?'.$query;
		//print_r($fullUri); exit;
		$client->setUri($this->_remoteHost . $path . '?'.$query);
		$headers = array('x-macys-webservice-client-id: testclient_1.0_kweu3w323a',
				'x-macys-customer-id: testclient_1.0_kweu3w323a',
				'Accept: application/json',
		);
		$client->setHeaders($headers);
		$client->send();
		
		if($client->getResponse()->isSuccess() || $client->getResponse()->isNotFound()) 
		{
			$this->_body = $client->getResponse()->getBody();
			$this->_statusCode = $client->getResponse()->getStatusCode();
			$reqStatus = true;
		}
		return $reqStatus;
		
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function getStatusCode()
	{
		return $this->_statusCode;
	}
	
	public function getBody(){
		return $this->_body;
	}
	
	/**
	 * get Remote host from Config table
	 */
	protected function getRemoteHost()
	{
		$isMock = false;
		$groupResp = $this->getServiceLocator()->get('Database\Configs');
		$result = $groupResp->findByName("Host");
		if(is_object($result) ){
			$this->_remoteHost = $result->getValue();
		}
		return $this->_remoteHost;
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