<?php
namespace Product\Schema ;



class  PrimaryImage extends GenericFactory {

	public $primaryImage ;

	public function __construct(){
		$this->primaryImage  = new Image\Image() ;
	}
}