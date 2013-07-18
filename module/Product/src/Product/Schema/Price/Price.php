<?php
namespace Product\Schema\Price;


class Price {
	
	public $original ;
	public $intermediatePrice;
	public $retail;
	public $pricetype =1;
	public $onsale = true;
	public $saleends = "Tomorrow";
	public $pricingpolicy = "If an item is further reduced in price within 14 days of when you purchased it, we’ll refund the difference in price when you present your original receipt. You may also present your order number, and we’ll look it up. Submit your request";
	
	
	public function __construct(){
		$this->original = new PriceLV("Original");
		$this->intermediatePrice = new PriceLV("Now");
		$this->retail = new PriceLV("Regular");
	}
	
}