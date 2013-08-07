<?php
namespace Mashery\Controller;

use Mock\Mvc\Controller\RestfulController;
use Zend\Loader\StandardAutoloader,
		Zend\Json\Server\Server,
		Zend\Json\Server\Smd;
use Zend\Json\Json;
use Zend\View\Model\ViewModel;

class MasheryController extends RestfulController {
	
	private $jsonrpc;
	
	protected $acceptCriteria = array(
			'Zend\View\Model\JsonModel' => array(
					'application/json',
			),);
	
	public function __construct(){
		$this->jsonrpc = new Server();
		$this->jsonrpc->setClass( new \Mashery\Server\Oauth2\Oauth2(),"oauth2");
		$this->jsonrpc->setClass(new \Mashery\Server\Api());
		$this->jsonrpc->getRequest()->setVersion(Server::VERSION_2);
	}
	
	public function get($id){
		$smd = $this->jsonrpc->getServiceMap()->setEnvelope(Smd::ENV_JSONRPC_2);
		//echo $smd; // $smd is a JSON response we are just allowing restful controller to take over
		return $this->mockModel(Json::decode($smd));
	}
	
	public function create($data){
			
			$this->jsonrpc->handle();
			// Add hack to allow JSON RPC server to complete the response 
			$View = new ViewModel ();
			$View->setTerminal (true);
			exit ();
	}
	
	public function getCustIdentifier(){
		$e = $this->getEvent();
		$routeMatch = $e->getRouteMatch();
		$request = $e->getRequest();
		return $this->getIdentifier($routeMatch, $request);
	}
	
}