<?php
namespace Product\Schema\ColorWay;

use Product\Schema\Image\Image;

class ColorWayImage {

	public $colornormal = "Beighe";
	public $color = "Dark Cherry";
	public $upcadditionalimage ;
	public $upcprimaryimage ;
	public $swatchsequencenumber = 1;
	public $swapoutsequencenumber = 3;
	public $swatchimage;
	public $isdefault = true;

	public $colorwayid = 1;
	 
	 public function __construct($id = 1) {
	 	$this->upcadditionalimage = new Image();
	 	$this->upcprimaryimage = new Image();
	 	$this->swatchimage = new Image();
	 	
	 	$this->swapoutsequencenumber = $id;
	 	$this->colorwayid = $id + 10;
	 	$this->swapoutsequencenumber = $id + rand(5,43);
	 }

}