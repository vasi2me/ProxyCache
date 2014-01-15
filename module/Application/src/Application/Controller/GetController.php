<?php
namespace Application\Controller;

use Mock\Mvc\Controller\RestfulController;
use Zend\Json\Exception\RuntimeException as JsonRuntimeException;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Json\Json;

use Zend\Http\Client as HttpClient;


use Zend\Db\TableGateway\TableGateway;
use Application\Http\Proxy;


class GetController extends RestfulController {

	
	
	

	public function getList(){
		$path = $this->getRequest()->getUri()->getPath();
		$query = $this->getRequest()->getUri()->getQuery();
		//print_r($this->getRequest()->getUri()); exit();
		
		//$re = new Proxy();
		$re = $this->getServiceLocator()->get('Application\Http\Proxy');
		$re->setPathQuery($path,$query);
		$re->process();
		
		$this->getResponse()->setStatusCode($re->getStatusCode());
		
		$jsonArray = json_decode($re->getBody());
		
		
		//$re->setPathQuery($path,$query);
		//$x = $re->addConfigValues('Mock','True');
		//$x = $re->isMockMode();
		//echo"<pre>";
		//print_r($x);
		
		/*
		$db = $this->getServiceLocator()->get('Zend\Db\Adapter');
		
		$tg = new TableGateway('uris', $db);
		$rowset = $tg->select();
		
		$artistRow = $rowset->current();
		
		var_dump($artistRow);
		
		/ *
		$client = new HttpClient();
		$client->setAdapter('Zend\Http\Client\Adapter\Curl');
		$client->setUri('http://services.qa15codemacys.fds.com/' . $path . '?'.$query);
		$headers = array('x-macys-webservice-client-id: testclient_1.0_kweu3w323a',
				'Accept: application/json',
				);
		
		$client->setHeaders($headers);
		$res = $client->send();
		//print_r($res->getHeaders()) ; exit;
		$jsonArray = json_decode($res->getBody());
		*/
		return $this->mockModel($jsonArray);
		
	}
	
	
	
	
	
}