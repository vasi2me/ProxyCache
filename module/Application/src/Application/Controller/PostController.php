<?php
namespace Application\Controller;

use Mock\Mvc\Controller\RestfulController;
use Zend\Json\Exception\RuntimeException as JsonRuntimeException;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Json\Json;

use Zend\Http\Client as HttpClient;


use Zend\Db\TableGateway\TableGateway;
use Application\Http\Proxy;

class PostController extends RestfulController {

	protected $notAuthorized = array("success"=>false, "errors"=> "Authorization missing");

	private function validateHeader($headers){
		$configTable = $this->getServiceLocator()->get('Database\Configs');
		if($configTable->checkFlagOf('ProxyHeaderCheck'))
		{
			$proxyHeader = $configTable->findByName('ProxyHeaderKeyValue');
			if(is_object($proxyHeader)){
				$h = $proxyHeader->current();
				print_r($h);
				//$keyValue = $h->getValue();
				$head = explode(':', $keyValue);
			}

			print_r($head); exit;
		}

		return false;

	}
	
	public function create($data){
		
		$path = $this->getRequest()->getUri()->getPath();
		$query = $this->getRequest()->getUri()->getQuery();
		
		$request  = $this->getRequest()->getHeaders('X-Macys-Webservice-Client-Id');
		if(!$request)
		{
			$this->getResponse()->setStatusCode(401);
			return $this->mockModel($this->notAuthorized);
		}
		//print_r($this->getRequest()->getUri()); exit();
		
		//$re = new Proxy();
		$re = $this->getServiceLocator()->get('Application\Http\Proxy');
		$re->setPathQuery($path,$query, 'POST');
		$re->process();
		
		$this->getResponse()->setStatusCode($re->getStatusCode());
		
		$jsonArray = json_decode($re->getBody());
		
		
		
		return $this->mockModel($jsonArray);
	}

	public function update($id,$data){
		$path = $this->getRequest()->getUri()->getPath();
		$query = $this->getRequest()->getUri()->getQuery();

		$request  = $this->getRequest()->getHeaders('X-Macys-Webservice-Client-Id');
		if(!$request)
		{
			$this->getResponse()->setStatusCode(401);
			return $this->mockModel($this->notAuthorized);
		}
		$re = $this->getServiceLocator()->get('Application\Http\Proxy');
		$re->setPathQuery($path,$query, 'PUT');
		$re->process();

		$this->getResponse()->setStatusCode($re->getStatusCode());
		$jsonArray = json_decode($re->getBody());
		return $this->mockModel($jsonArray);
	}

	public function delete($id){
		$path = $this->getRequest()->getUri()->getPath();
		$query = $this->getRequest()->getUri()->getQuery();

		$request  = $this->getRequest()->getHeaders('X-Macys-Webservice-Client-Id');
		if(!$request)
		{
			$this->getResponse()->setStatusCode(401);
			return $this->mockModel($this->notAuthorized);
		}
		$re = $this->getServiceLocator()->get('Application\Http\Proxy');
		$re->setPathQuery($path,$query, 'DELETE');
		$re->process();

		$this->getResponse()->setStatusCode($re->getStatusCode());
		$jsonArray = json_decode($re->getBody());
		return $this->mockModel($jsonArray);
	}
}