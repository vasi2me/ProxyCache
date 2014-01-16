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
			
			$headers = $this->getOriginHeaders();
			if($headers)
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

		$groupResp = $this->getServiceLocator()->get('Database\Configs');
		$result = $groupResp->findByName("Host");
		if(is_object($result) ){
			$result1 = $result->current();
			$this->_remoteHost = $result1->getValue();
		}
		return $this->_remoteHost;
	}


	protected function getOriginHeaders(){
		$groupResp = $this->getServiceLocator()->get('Database\Configs');
		$result = $groupResp->findByName("OriginHeader");
		if(!is_object($result))
			return false;
		$headers = array();
		foreach ($result->toArray() as $headArray) {
			$headers[] = $headArray['value'];
		}
		return $headers;
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