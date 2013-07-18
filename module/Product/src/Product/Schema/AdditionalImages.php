<?php
namespace Product\Schema ;



class AdditionalImages  extends GenericFactory {

	public $additionalImages ;

	public function __construct(){
		$this->additionalImages  = array(new Image\Image(), new Image\Image) ;
	}
}