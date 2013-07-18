<?php
namespace Product\Schema\Price;



class PriceLV {
	
	public $pricelabel;
	public $pricevalue;
	
	public function __construct($label = "pricelable") {
		$this->pricelabel = $label;
		$this->pricevalue = rand(10,2000);
	}
	
}