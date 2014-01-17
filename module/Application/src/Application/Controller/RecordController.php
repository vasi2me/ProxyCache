<?php
namespace Application\Controller;




use Mock\Mvc\Controller\RestfulController;

class RecordController extends RestfulController
{
	
	
	public function getList()
	{
		
		print_r($this->getRequest()); 
		exit;
		
	}
	
	public function create($d)
	{
		print_r($this->getRequest());
		exit;
	}
	
	
}