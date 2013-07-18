<?php
namespace Product\Schema ;



class  Price  extends GenericFactory {

	public $price ;

	public function __construct(){
		$this->price  = new Price\Price() ;
	}
}