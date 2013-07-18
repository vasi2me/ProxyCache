<?php
namespace Product\Schema ;



class Attributes  extends GenericFactory {

	public $attributes ;

	public function __construct(){
		$this->attributes  = array (new Attribute\Attribute()) ;
	}
}