<?php
namespace Akamai\Server;

class ParseRequest {
	
	/**
	 * Return 'Hello World!'
	 * @return string
	 */
	public function helloworld()
	{
		return 'Hello World!';
	}
	
	/**
	 * Get the sum of two variables
	 * @param int $a
	 * @param int $b
	 * @return int
	 */
	public function sum($a, $b)
	{
		return $a + $b;
	}
	
}