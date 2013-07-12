<?php
namespace Akamai\Server;



class PurgeApi {
	
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
		$x->modifiers = array("hi","name", "type"=>"idontknow");
		$x->resultCode = 200;
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