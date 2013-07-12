<?php
namespace Akamai\Controller;

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
	
}