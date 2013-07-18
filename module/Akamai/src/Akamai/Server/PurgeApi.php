<?php
namespace Akamai\Server;

use Akamai\Service\Database;



class PurgeApi {
	
	/*implements ServiceLocatorAwareInterface {
}
  protected $serviceLocator;

  public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
    $this->serviceLocator = $serviceLocator;
  }

  public function getServiceLocator() {
    return $this->serviceLocator;
  }*/
	
	/**
	 * 
	 * @param string $name
	 * @param string $pwd
	 * @param string $network
	 * @param array $opt
	 * @param array $uri
	 * @return \Akamai\Server\PurgeResult
	 */
	public function purgeRequest($name, $pwd, $network, $opt, $uri	)
	{
		$x = new PurgeResult();
		$x->estTime = 2;
		
		$x->modifiers = array($name =>$pwd,'network'=>$network, "opt"=>$opt,'uri'=>serialize($uri));
		$x->resultCode = 100;
		$x->sessionId = "ewrewerw";
		$x->resultMsg = "xaere erew";
		$x->uriIndex = 0;
		
		return $x;
		
	}
	
	/* 
	 * public function purgeRequest(string $name,
			string $pwd,
			string $network, 
			array $opt, 
			array $uri	)
	 * 
	 */
}