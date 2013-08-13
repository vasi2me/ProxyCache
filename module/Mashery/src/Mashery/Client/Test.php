<?php
namespace Mashery\Client;

use Zend\Json\Server\Request;

use Zend\Json\Server\Client;

class Test {
	
	public $apiKey  = "vy4mfeumrqg7eznhbawuqvas";
	public $secret = "QTcACwkpr8";
	public $publicKey = "wyd8kq8urze3fxd5typhx5pu";
	
	public	$areaId=266;
	
	
	public function doCall(){
		//$client = new Zend\Http\Client('https://www.example.com', $config);
		
		$c = new  Client($this->generateURL());
		//naxh2jz9t3tk3x948j9tzvj7
		$cli = $c->getHttpClient();
		$adapter = new \Zend\Http\Client\Adapter\Curl();
	$adapter->setOptions(array(
    'curloptions' => array(
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2,
       // CURLOPT_CAINFO => '/etc/ssl/certs/ca-bundle.pem'
    )
));
		
		$cli->setAdapter($adapter);
		$request = new Request();
		
		
		$request->addParam("SELECT secret FROM keys where apikey='naxh2jz9t3tk3x948j9tzvj7'", "clientSecretQuery");
		$request->setMethod("object.query");
		$request->setVersion("2.0");
		$request->setId(131);
		
		$c->doRequest($request);
		print_r($c->getLastResponse());
		
	}
	
	public function generateURL(){
		$milliseconds = round(microtime(true) * 1000);
		
		$mdurl = md5($this->apiKey + $this->secret + $milliseconds);
		//https://api.mashery.com/
		$urlq = "https://api.mashery.com/v2/json-rpc/266?public_key=" . $this->publicKey . "&apikey=" . $this->apiKey . "&sig=".$mdurl;
		//print_r($urlq);exit;
		return $urlq;
		
	}
	
}