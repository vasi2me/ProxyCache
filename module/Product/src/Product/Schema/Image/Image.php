<?php
namespace Product\Schema\Image;


class Image {
	
	public $imagetype ;
	public $sequenceNumber = 1;
	public $imagename = "someimage.tif";
	//<!--<xs:element name="imageurl" type="xs:string" minOccurs="0"/>removed, URL will be built by client from meta-info added-->
	//<!--<xs:element name="colorized" type="xs:boolean" minOccurs="0"/> removed, not needed-->
	
	public function __construct(){
		$this->imagetype = array_rand (array("TARGET",
		"SWATCH",
		"COLORWAY",
		"PRIMARY_IMAGE",
		"UPC_PRIMARY_IMAGE",
		"LANDSCAPE_IMAGE",
		"ADDITIONAL_IMAGE",
		"UPC_ADDITIONAL_IMAGE",
		"PORTRAIT_IMAGE",
		"SIZE_CHART"));
	}
}