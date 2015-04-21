<?php
namespace Application\Service;



use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Database implements FactoryInterface
{
	protected $servicelocator;
	
	private $_path;
	private $_query;
	private $_httpmethod;
	private $_urisId;
	private $_responesId = 0;
	private $_body = null;
	private $_headers;
	private $_cookies;
	private $_responseCode;
	private $_useMock;
	
	private $_fromDb;
	
	
	private $_failReason = array();
	
	public function saveToDb($path, $body,$httpMethod,$responseCode=200,$useMock = true, $query=null, $headers=null, $cookies=null){
		$this->_path = $path;
		$this->_query = $query;
		$this->_httpmethod = $httpMethod;
		
		$this->_body = $this->convertBodyToJson($body);
		$this->_headers = $headers;
		$this->_cookies = $cookies;
		$this->_responseCode = $responseCode;
		$this->_useMock = $useMock;
		$this->isExistInDB();
		$this->save();
	}
	
	private function convertBodyToJson($arr){
		return json_encode($arr);
	}
	
	protected function save(){
		$Uris = $this->getServiceLocator()->get('Database\Uris');
		if($this->_urisId == 0 )
		{
			$d = $Uris->saveByPathQuery($this->_path, $this->_query, $this->_httpmethod);
			$this->_urisId = $d->getGeneratedValue();
		}
		$response = $this->getServiceLocator()->get('Database\Responses');
	
		$rEntity = new \Application\Database\Entity\Responses();
		$rEntity->setBody($this->_body);
		$rEntity->setCode($this->_responseCode);
		//if($this->_useMock)
		//	$rEntity->setUsemock($this->_useMock);
	
		if(!isset($this->_responseId) || $this->_responseId == 0)
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
	
	public function getMessages(){
		return $this->_failReason;
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
			
			$this->_failReason[] = "Entry Already existing hence Updating as per Input";
		}
		else {
			
			$this->_fromDb = false;
			//$this->_responseId = 0;
			//$this->_urisId = 0;
			$this->_failReason[] = "Creating new entry as per Input";
		}
		return $this->_fromDb;
	}
	
	
	/**
	 * Identify whether we are currently in Record/proxy / DB Mock
	 */
	public function isMockMode()
	{
		$groupResp = $this->getServiceLocator()->get('Database\Configs');
		$mockMode = $groupResp->checkFlagOf("Mock");
		if(!$mockMode)
			$this->_failReason[] = "Mock Config set to False";
		
		return $mockMode;
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