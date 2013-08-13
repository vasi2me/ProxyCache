<?php
namespace Mashery\Controller;



use Mashery\Client\Test;

use Mock\Mvc\Controller\RestfulController;
use Zend\Json\Server\Server;
use Zend\Json\Server\Smd;
use Zend\Json\Json;
use Zend\View\Model\ViewModel;

class MasheryController extends RestfulController  {

	private $jsonrpc;


	
	public function get($id){
$x = new Test();
$x->doCall();
/*		
		$this->intializeJsonRpc();
		$smd = $this->jsonrpc->getServiceMap()->setEnvelope(Smd::ENV_JSONRPC_2);
		//echo $smd; // $smd is a JSON response we are just allowing restful controller to take over
		return $this->mockModel(Json::decode($smd));*/
return $this->mockModel(array());
	}

	public function create($data){

		$this->intializeJsonRpc();
		$this->logQueryParams();


		$this->jsonrpc->handle();
		// Add hack to allow JSON RPC server to complete the response
		$View = new ViewModel ();
		$View->setTerminal (true);
		exit ();
	}

	public function logQueryParams(){



		$e = $this->getEvent();
		//$routeMatch = $e->getRouteMatch();
		$request = $e->getRequest();
		$this->getLogger()->debug("public_key : " . $request->getQuery()->get("public_key"));
		$this->getLogger()->debug("apikey : " . $request->getQuery()->get("apikey"));
		$this->getLogger()->debug("sig : " . $request->getQuery()->get("sig"));
		return $this;
	}


	private function intializeJsonRpc(){
		$Oauth2 = $this->getServiceLocator()->get('Mashery\Oauth2');

		$this->jsonrpc = new Server();
		$this->jsonrpc->setClass( $Oauth2,"oauth2");
		$this->jsonrpc->getRequest()->setVersion(Server::VERSION_2);
		return $this;
	}

}