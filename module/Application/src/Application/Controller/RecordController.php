<?php
namespace Application\Controller;




use Mock\Mvc\Controller\RestfulController;

class RecordController extends RestfulController
{
	private $_recordingProcessor;
	
	private  function setRequest($incommingRequest=null, $data){
		$requestProcessor = $this->getServiceLocator()->get('Application\Service\Recording');
		$requestProcessor->setRequest($incommingRequest, $data);
		
		$this->getResponse()->setStatusCode($requestProcessor->getStatusCode());
		$responseBody = $requestProcessor->getBody();
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
	
	public function delete($id){
		print_r($this->getRequest()); exit;
		$this->getResponse()->setStatusCode(400);
		$res = $this->notImplemented;
		return $this->mockModel($res);
	}
	
	private function getRequestProcessor(){
		$this->_recordingProcessor = $this->getServiceLocator()->get('Application\Service\Recording');
	}
	
	private function setRequest1($request=null, $data=null){
		$this->_recordingProcessor->setRequest($request, $data);
	}
}