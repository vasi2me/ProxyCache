<?php
namespace Mashery\Server\Oauth2;
use Zend\Json\Server\Exception\InvalidArgumentException;

class Oauth2
{

	/**
	 * 
	 * @param string $service_key
	 * @param string $client_id
	 * @param string $client_secret
	 * @param string $access_token
	 * @param string $scope
	 * @param string $user_context
	 * @param int $expires_in
	 * @return \Mashery\Server\Oauth2\Result
	 */
	public function updateAccessToken($service_key, $client_id,$access_token, $client_secret = null,   $scope=null, 
			$user_context=null, $expires_in=null)
	{
		return (array) new Result();
	}
}