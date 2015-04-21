<?php
namespace Application\Http;



use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Proxy implements FactoryInterface
{
	protected $servicelocator;


	private $_path;
	private $_query;
	private $_httpmethod;

	private $_fromDb = false;
	private $_urisId =0;
	private $_responseId = 0;
	private $_storeInDb = false;

	private $_body = null;
	private $_status = 500;


	public function setPathQuery($path, $query, $method='GET')
	{
		$this->_path = $path;
		$this->_query = $query;
		$this->_httpmethod = $method;
	}

	public function process(){

		if($this->isExistInDB() && $this->isMockMode()){
				
			$response = $this->getServiceLocator()->get('Database\Responses');
			$dbResp = $response->findById($this->_responseId);
			$this->_body = $dbResp->getBody();
			$this->_status = $dbResp->getCode();
				
		}
		else if($this->_httpmethod == 'GET') {
			$cli = $this->getServiceLocator()->get('Application\Http\Client');
			if($cli->remoteRequest($this->_path,$this->_query))
			{
				$this->_body = $cli->getBody();
				$this->_status = $cli->getStatusCode();
				$this->saveToDb();
			}
		}
		else if($this->_httpmethod == 'POST'){
			$this->_body = '{"Error":"Please set POST response manually with HTTP Status code in ProxyCache DB","Error2":"This request will not be proxied"}';
			$this->_status = 200;
			$this->saveToDb();
		}

		else if($this->_httpmethod == 'PUT'){
			$this->_body = '{"Error":"Please set PUT response manually with HTTP Status code in ProxyCache DB","Error2":"This request will not be proxied"}';
			$this->_status = 200;
			$this->saveToDb();
		}

		else if($this->_httpmethod == 'DELETE'){
			$this->_body = '{"Error":"Please set DELETE response manually with HTTP Status code in ProxyCache DB","Error2":"This request will not be proxied"}';
			$this->_status = 200;
			$this->saveToDb();
		}

		else if($this->_httpmethod == 'PATCH'){
			$this->_body = '{"Error":"Please set PATCH response manually with HTTP Status code in ProxyCache DB","Error2":"This request will not be proxied"}';
			$this->_status = 200;
			$this->saveToDb();
		}


	}

	protected function saveToDb(){
		$Uris = $this->getServiceLocator()->get('Database\Uris');
		if($this->_urisId == 0 )
		{
			$d = $Uris->saveByPathQuery($this->_path, $this->_query, $this->_httpmethod);
			$this->_urisId = $d->getGeneratedValue();
		}
		$response = $this->getServiceLocator()->get('Database\Responses');

		$rEntity = new \Application\Database\Entity\Responses();
		$rEntity->setBody($this->_body);
		$rEntity->setCode($this->_status);
		
		if($this->_responseId == 0)
		{
			$dyid = $response->save($rEntity);
			$this->_responseId = $dyid->getGeneratedValue();
			$uriUpdate = $Uris->findById($this->_urisId);
				
			$uriUpdate->setResponseId($this->_responseId);
			$uriUpdate->setUsemock(1);
			//print_r($uriUpdate); exit;
			$Uris->save($uriUpdate);
		}
		else {
			$rEntity->setId($this->_responseId);
			$dyid = $response->save($rEntity);
		}
	}



	public function getStatusCode()
	{
		return $this->_status;
	}

	public function getBody()
	{
		return $this->_body;
	}

	public function getValue()
	{
		$Uris = $this->getServiceLocator()->get('Database\Uris');
		$d = $Uris->findByPathQuery($this->_path, $this->_query);

		//$d = $Uris->fetchAll();
		return $d;
	}


	public function addConfigValues($name, $value){
		$config = $this->getServiceLocator()->get('Database\Configs');
		$d = $config->saveByNameValue($name, $value);
		return $d;
	}


	protected function isExistInDB(){
		$Uris = $this->getServiceLocator()->get('Database\Uris');
		$x = $Uris->findByPathQuery($this->_path, $this->_query, $this->_httpmethod);

		if(is_object($x))
		{
			$this->_urisId = $x->getId();
			$this->_responseId = $x->getResponseId();
			$this->_httpmethod = $x->getHttpMethod();
				
		}

		if(is_object($x) && $x->getUsemock() == TRUE && $x->getResponseId() > 0) {
			$this->_fromDb = true;
			$this->_storeInDb = false;
		}
		else {
			$this->_storeInDb = true;
			$this->_fromDb = false;
			//$this->_responseId = 0;
			//$this->_urisId = 0;
		}
		return $this->_fromDb;
	}

	/**
	 * Identify whether we are currently in Record/proxy / DB Mock
	 */
	public function isMockMode()
	{
		$groupResp = $this->getServiceLocator()->get('Database\Configs');
		return $groupResp->checkFlagOf("Mock");
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