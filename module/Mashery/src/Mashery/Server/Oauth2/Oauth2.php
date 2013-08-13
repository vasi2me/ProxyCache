<?php
namespace Mashery\Server\Oauth2;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Log\LoggerInterface;

use Zend\Log\LoggerAwareInterface;


use Zend\Json\Server\Exception\InvalidArgumentException;

class Oauth2 implements LoggerAwareInterface, FactoryInterface
{

	protected $logger;
	
	protected $service_key;
	protected $client;
	protected $client_id;
	protected $client_secret;
	protected $redirect_uri;
	protected $scope;
	protected $response_type;
	protected $state;
	protected $access_token;
	
	
	public function fetchApplication($publicApi, $client = array(), $uri=array(), $responseType=null)
	{
		
	}
	
	
	
	public function createAuthorizationCode($publicApi, $client = array(), $uri=array(), $scope, $userContext)
	{
	
	}
	
	
	
	public function createAccessToken()
	{
	
	}
	
	
	
	public function fetchAccessToken($service_key, $access_token)
	{
	
	}
	
	
	
	/*
	 * {
    "id": 312,
    "jsonrpc": "2.0",
    "method": "oauth2.updateAccessToken",
    "params": {
        "service_key": "3uy3uq5usrkyt779kg8fsjw9",
"client" : {
            "client_id": "j2vq8whekmp289qtdhdpqzvn",
            "client_secret": "3zUGjsUSGE" },
        "access_token": "6wrs5akgfmunv74shk7jdx3u",
        "scope": "myscope",
        "user_context": "myusercontext",
        "expires_in": 60
    }
}
	 */
	
	
	/**
	 *
	 * @param string $service_key
	 * @param array $client
	 * @param string $access_token
	 * @param string $scope
	 * @param string $user_context
	 * @param int $expires_in
	 * @return \Mashery\Server\Oauth2\Result
	 */
	public function updateAccessToken($service_key, $client = null,$access_token,    $scope=null,
			$user_context=null, $expires_in=null)
	{
		$this->extractClient($client);
		$this->service_key = $service_key;
		$this->scope = $scope;
		$this->access_token = $access_token;
		
		$this->getLogger()->debug("Service Key : " . $this->service_key);
		$this->getLogger()->debug("Client ID : " . $this->client_id);
		$this->getLogger()->debug("Access Token : " . $this->access_token);
		$this->getLogger()->debug("Client Secret : " . $this->client_secret);
		$this->getLogger()->debug("Scope : " . $this->scope);
		return (array) new Result();
	}
	
	private function extractClient($client){
		if(isset($client["client_id"]))
				$this->client_id = $client["client_id"];
		if(isset($client["client_secret"]))
			$this->client_secret =  $client["client_secret"];
	}
	
	public function setLogger(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}
	
	public function getLogger()
	{
		return $this->logger;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator){
		return $this;
	}
}