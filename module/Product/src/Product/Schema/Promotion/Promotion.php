<?php
namespace Product\Schema\Promotion;

use Product\Schema\Attributes;

class Promotion {
	
	public $promotionID = 32323;
	public $promotionType = "Doller Off";
	public $offerDescription = "10 Doller Off on purchase of 100";
	public $description = "10 Doller Off on purchase of 100 as description";
	public $giftProductId = 323432;
	public $giftProdquantity = 2;
	public $discountedPrice = 90;
	public $attributes ;
	
	public function __construct() {
		$this->attributes = new Attributes();
	}
	
	
}