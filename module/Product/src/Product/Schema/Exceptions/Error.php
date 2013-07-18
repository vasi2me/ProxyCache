<?php
namespace Product\Schema\Exceptions;


class Error {
	
	public $errorCode = 400;
	public $message = "Unexpected Error Occured happend";
	public $errorDetail =  "Unexpected Error Occured";
	public $success = false;
	
	public $product = 45;
	public $upc = 4324242;
	
	public function __construct($errName = "un-known"){
		$this->message = $errName . "Error Occured";
		
	}
	
}