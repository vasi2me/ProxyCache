<?php
namespace Product\Schema ;



class ColorMap  extends GenericFactory  {

	public $colormap ;

	public function __construct(){
		$this->colormap  = new ColorWay\ColorWayImage(1);
	}
}