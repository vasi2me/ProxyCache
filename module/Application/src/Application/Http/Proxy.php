<?php
namespace Application\Http;



use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Proxy implements FactoryInterface
{
	protected $servicelocator;


	private $_path;
	private $_query;

	private $_fromDb = false;
	private $_urisId =0;
	private $_responseId = 0;
	private $_storeInDb = false;

	private $_body = null;
	private $_status = 500;


	public function setPathQuery($path, $query)
	{
		$this->_path = $path;
		$this->_query = $query;
	}

	public function process(){

		if($this->isExistInDB() && $this->isMockMode()){
				
			$response = $this->getServiceLocator()->get('Database\Responses');
			$dbResp = $response->findById($this->_responseId);
			$this->_body = $dbResp->getBody();
			$this->_status = $dbResp->getCode();
				
		}
		else {
			$cli = $this->getServiceLocator()->get('Application\Http\Client');
			if($cli->remoteRequest($this->_path,$this->_query))
			{
				$this->_body = $cli->getBody();
				$this->_status = $cli->getStatusCode();
				$this->saveToDb();
			}
		}


	}

	protected function saveToDb(){
		$Uris = $this->getServiceLocator()->get('Database\Uris');
		if($this->_urisId == 0 )
		{
			$d = $Uris->saveByPathQuery($this->_path, $this->_query);
			$this->_urisId = $d->getGeneratedValue();
		}
		$response = $this->getServiceLocator()->get('Database\Responses');

		if($this->_responseId == 0)
		{
			$rEntity = new \Application\Database\Entity\Responses();
			$rEntity->setBody($this->_body);
			$rEntity->setCode($this->_status);
			$dyid = $response->save($rEntity);
				
			$this->_responseId = $dyid->getGeneratedValue();
			$uriUpdate = $Uris->findById($this->_urisId);
				
			$uriUpdate->setResponseId($this->_responseId);
			$uriUpdate->setUsemock(1);
			//print_r($uriUpdate); exit;
			$Uris->save($uriUpdate);
				
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


	protected function saveRequestToDB(){


	}

	protected function isExistInDB(){
		$Uris = $this->getServiceLocator()->get('Database\Uris');
		$x = $Uris->findByPathQuery($this->_path, $this->_query);

		if(is_object($x))
		{
			$this->_urisId = $x->getId();
			$this->_responseId = $x->getResponseId();
				
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
		$isMock = false;
		$groupResp = $this->getServiceLocator()->get('Database\Configs');
		$result = $groupResp->findByName("Mock");
		if(is_object($result) ){
			if($result->getValue() == 1 || $result->getValue() == 'TRUE'
					|| $result->getValue() == 'true' || $result->getValue() == 'True')
				$isMock = TRUE;
		}
		return $isMock;
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