<?php
namespace Product\Schema;

use Product\Schema\Upc\Upc;


class Upcs extends GenericFactory {
	
	public $upcs = array();

	
	
	public function __construct(){
		$this->upcs = array( new Upc());
	}
	
	
}