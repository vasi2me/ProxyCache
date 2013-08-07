<?php
namespace Mashery\Server;
use Zend\Json\Server\Exception\InvalidArgumentException;


class Api {
	
	/**
	 * Return the current timestamp
	 *
	 * @return int
	 */
	public function apiping()
	{
		return time();
	}
}