<?php
namespace Application\Database\Entity;


class Responses  implements EntityInterface
{

	public $id;
	public $code;
	public $message;
	public $body;
	public $headers;
	public $cookies;



	/**
	 * Get id.
	 *
	 * @return int
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Set id.
	 *
	 * @param int $id
	 * @return EntityInterface
	 */
	public function setId($id){
		$this->id = $id;
		return $this;
	}

	/**
	 * Get schema.
	 *
	 * @return string
	 */
	public function getCode(){
		return $this->code;
	}

	/**
	 * Set schema.
	 *
	 * @param string $schema
	 * @return EntityInterface
	 */
	public function setCode($code){
		$this->code = $code;
		return $this;
	}

	/**
	 * Get message.
	 *
	 * @return string
	 */
	public function getMessage(){
		return $this->message;
	}

	/**
	 * Set message.
	 *
	 * @param string $message
	 * @return EntityInterface
	 */
	public function setMessage($message){
		$this->message = $message;
		return $this;
	}

	/**
	 * Get body.
	 *
	 * @return string
	 */
	public function getBody(){
		return $this->body;
	}

	/**
	 * Set body.
	 *
	 * @param string $body
	 * @return EntityInterface
	 */
	public function setBody($body){
		$this->body = $body;
		return $this;
	}


	/**
	 * Get headers.
	 *
	 * @return string
	 */
	public function getHeaders(){
		return $this->headers;
	}

	/**
	 * Set headers.
	 *
	 * @param string $headers
	 * @return EntityInterface
	 */
	public function setHeaders($headers){
		$this->headers = $headers;
		return $this;
	}



	/**
	 * Get cookies.
	 *
	 * @return string
	 */
	public function getCookies(){
		return $this->cookies;
	}

	/**
	 * Set cookies.
	 *
	 * @param string $cookies
	 * @return EntityInterface
	 */
	public function setCookies($cookies){
		$this->cookies = $cookies;
		return $this;
	}





}