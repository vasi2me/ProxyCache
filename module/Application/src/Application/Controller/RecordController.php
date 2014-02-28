<?php
namespace Application\Controller;




use Mock\Mvc\Controller\RestfulController;

class RecordController extends RestfulController
{
	private  function setRequest($incommingRequest=null, $data){
		$requestProcessor = $this->getServiceLocator()->get('Application\Service\Recording');
		$requestProcessor->setRequest($incommingRequest, $data);
		
		$this->getResponse()->setStatusCode($requestProcessor->getStatusCode());
		$responseBody = $requestProcessor->getBody();
		$jsonArr = array("success"=>false);
		return $this->mockModel($responseBody);
	}
	
	public function getList()
	{
		
		$this->setRequest($this->getRequest());
		exit;
		
	}
	
	public function create($data=null)
	{
		
		return $this->setRequest($this->getRequest(), $data);
		
		
	}
	
	
}