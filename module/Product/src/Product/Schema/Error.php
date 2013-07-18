<?php
namespace Product\Schema;


class Error extends GenericFactory {
	
	
	public $errors;

	public function __construct($errorNm = "Un-expected") {
		$this->errors[] = new Exceptions\Error($errorNm);
	}
	
}