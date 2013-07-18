<?php
namespace Product\Schema ;





class  Rebates  extends GenericFactory {

	public $rebates ;

	public function __construct(){
		$this->rebates  = new Rebate\Rebate();
	}
}