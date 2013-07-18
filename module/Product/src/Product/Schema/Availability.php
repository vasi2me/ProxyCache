<?php
namespace Product\Schema ;



class  Availability  extends GenericFactory {

	public $availability ;

	public function __construct(){
		$this->availability  = new Availability\Availability() ;
	}
}