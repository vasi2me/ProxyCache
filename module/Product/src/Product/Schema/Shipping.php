<?php

namespace Product\Schema;



class Shipping extends GenericFactory {
	
	public $shipping;
	
	public function __construct(){
		$this->shipping = new Shipping\Shipping();
	}
}
