<?php
namespace Product\Schema ;



class  SizeMap  extends GenericFactory {

	public $sizemap ;

	public function __construct(){
		$this->sizemap  = array(new Size\Size(1), new Size\Size(2));
	}
}