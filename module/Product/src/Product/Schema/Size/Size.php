<?php
namespace Product\Schema\Size;


class Size {
	
	public $size = "5.5M"; 
	public $sequencenumber = 1;
	/*
	<!--<xs:element name="imageurl" type="xs:string" minOccurs="0"/>removed, URL will be built by client from meta-info added-->
	<!--<xs:element name="colorized" type="xs:boolean" minOccurs="0"/> removed, not needed--> */
	public $sizeid = 1;
	
	public function __construct($id = 1){
		$this->sizeid = $id;
		$this->sequencenumber = $id;
	}
	
	
}