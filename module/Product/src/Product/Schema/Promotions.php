<?php
namespace Product\Schema;



class  Promotions extends GenericFactory {

	public $promotions ;

	public function __construct(){
		$this->promotions  = new Promotion\Promotion();
	}
}