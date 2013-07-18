<?php
namespace Product\Schema ;



class Corpclass  extends GenericFactory   {

	public $corpclass ;

	public function __construct(){
		$this->corpclass  = new Corpclass\Corpclass() ;
	}
}