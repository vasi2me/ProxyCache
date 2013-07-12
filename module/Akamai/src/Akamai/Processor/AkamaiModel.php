<?php
namespace Akamai\Processor;


class AkamaiModel {
	
	public $id;
	public $sessionId;
	public $resultCode;
	public $uri;
	public $opt;
	public $additional;
	public $created;
	
	public function exchangeArray($data)
	{
		if (isset($data['id'])) {
			$this->id = $data['id'];
		} else {
			$this->id = null;
		}
		
		if (isset($data['sessionId'])) {
			$this->sessionId = $data['sessionId'];
		} else {
			$this->sessionId = null;
		}
	
		if (isset($data['resultCode'])) {
			$this->resultCode = $data['resultCode'];
		} else {
			$this->resultCode = null;
		}
		
		if (isset($data['uri'])) {
			$this->uri = $data['uri'];
		} else {
			$this->uri = null;
		}
		
		if (isset($data['opt'])) {
			$this->opt = $data['opt'];
		} else {
			$this->opt = null;
		}
		
		if (isset($data['additional'])) {
			$this->additional = $data['additional'];
		} else {
			$this->additional = null;
		}
	
		
	
		if (isset($data['created'])) {
			$this->created = $data['created'];
		} else {
			$this->created = null;
		}
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
	
	
}