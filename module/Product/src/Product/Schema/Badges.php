<?php
namespace Product\Schema ;



class Badges  extends GenericFactory  {

	public $badges ;

	public function __construct(){
		$this->badges  = new Badge\Badge();
	}
}