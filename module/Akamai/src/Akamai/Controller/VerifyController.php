<?php
namespace Akamai\Controller;

use Akamai\Processor\AkamaiModel;

use Zend\View\Model\ViewModel;

use Zend\Mvc\Controller\AbstractActionController;

class VerifyController extends AbstractActionController {
	
	
	public function indexAction(){
		$sm = $this->getServiceLocator();
		
		$akamaiTable =	$this->getServiceLocator()->get('Akamai\Processor\AkamaiTable');
		print_r($akamaiTable->fetchAll());
		
	}
	
	public function lastAction(){
		
	}
	
	public function allAction(){
		
	}
	
	public function lasthourAction(){
		
	}
	
	public function insertAction(){
		
		$x = new AkamaiModel();
		
		$x->sessionId = rand(0,100);
		$x->resultCode = 200;
	
		$sm = $this->getServiceLocator();
		
		$akamaiTable =	$this->getServiceLocator()->get('Akamai\Processor\AkamaiTable');
		$akamaiTable->getTableGateway()->insert($x);
	}
	
}