<?php
namespace Application\Database\Entity;


class Uris  implements EntityInterface
{

	public $id;
	public $schema;
	public $timestamp;
	public $path;
	public $query;
	public $usemock;
	public $response_id;
	public $http_method;


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
	public function getSchema(){
		return $this->schema;
	}

	/**
	 * Set schema.
	 *
	 * @param string $schema
	 * @return EntityInterface
	 */
	public function setSchema($schema){
		$this->schema = $schema;
		return $this;
	}

	/**
	 * Get timestamp.
	 *
	 * @return string
	 */
	public function getTimestamp(){
		return $this->timestamp;
	}

	/**
	 * Set timestamp.
	 *
	 * @param string $timestamp
	 * @return EntityInterface
	 */
	public function setTimestamp($timestamp){
		$this->timestamp = $timestamp;
		return $this;
	}

	/**
	 * Get path.
	 *
	 * @return string
	 */
	public function getPath(){
		return $this->path;
	}

	/**
	 * Set path.
	 *
	 * @param string $path
	 * @return EntityInterface
	 */
	public function setPath($path){
		$this->path = $path;
		return $this;
	}


	/**
	 * Get query.
	 *
	 * @return string
	 */
	public function getQuery(){
		return $this->query;
	}

	/**
	 * Set query.
	 *
	 * @param string $query
	 * @return EntityInterface
	 */
	public function setQuery($query){
		$this->query = $query;
		return $this;
	}



	/**
	 * Get usemock.
	 *
	 * @return string
	 */
	public function getUsemock(){
		return $this->usemock;
	}

	/**
	 * Set usemock.
	 *
	 * @param string $usemock
	 * @return EntityInterface
	 */
	public function setUsemock($usemock){
		$this->usemock = $usemock;
		return $this;
	}



	/**
	 * Get response_id.
	 *
	 * @return int
	 */
	public function getResponseId(){
		return $this->response_id;
	}

	/**
	 * Set response_id.
	 *
	 * @param int $response_id
	 * @return EntityInterface
	 */
	public function setResponseId($response_id){
		$this->response_id = $response_id;
		return $this;
	}

	/**
	 * Get http_method.
	 *
	 * @return int
	 */
	public function getHttpMethod(){
		return $this->http_method;
	}

	/**
	 * Set http_method.
	 *
	 * @param int $response_id
	 * @return EntityInterface
	 */
	public function setHttpMethod($http_method){
		$this->http_method = $http_method;
		return $this;
	}


}