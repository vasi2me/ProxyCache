<?php
namespace Product\Schema ;



class Brand  extends GenericFactory {

	public $brand ;

	public function __construct(){
		$this->brand  = new Brand\Brand() ;
	}
}