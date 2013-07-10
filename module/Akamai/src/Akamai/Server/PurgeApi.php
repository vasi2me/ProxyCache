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
		return new PurgeResult();
		
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