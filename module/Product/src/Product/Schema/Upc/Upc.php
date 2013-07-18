<?php
namespace Product\Schema\Upc;


use Product\Schema\Attributes;

class Upc {
	
	
	public $modelnumber = "DFEWMK";
	public $skuid = 323423;
	public $hostPriceIndicator = "MST";
	public $defaultMediaCode = "STELLA";
	public $addByApp = "MCOM";
	public $nrfColorDescription = "black";
	public $nrfColorCode = "FFF";
	public $baseFeeExempt= false;
	public $surchargeFee= 2.0;
	public $history = false;
	public $backorderable = true;
	public $active= true;
	//<!--Color and Size Map referenced in UPC-->
	public $colorwayid = 423;
	public $sizeid = 4344;
	
	// type="attribute" minOccurs="0"/><!--Complex Types-->
	public $attributes = array();
	public $price = array ("orginal" => array("pricelabel"=>"Orginal", "value"=>43.4),
			"intermediatePrice" => array("pricelabel"=>"Was Price", "value"=>43.2),
			"retail" => array("pricelabel"=>"Retail", "value"=>45));
	 
	// type="UPCavailability" minOccurs="0"/>
	public $availability = array ( "available" => true,
			"shipDays"=> 3,
			"orderMethod"=> "POOL",
			"giftWrappable"=> true,
			"giftMessageable"=>true,
			"source"=> "FDFL",
			"shippingMethodsCode"=> 3,
			"shipMethodsSource"=> "FDFL",
			"inStoreEligibility"=> true,
			"inventoryStatusCode"=> "AVAIL",
			"upcAvailabilityMessage"=> "Will be shipped in 3 days",
			"upcId" => 323423);
	 
	 
	 
	// public $bopsavailability" type="bopsavailability" minOccurs="0"/>
	
	public $upcnumber = 432423432235324;
	
	
	public function __construct(){
		$this->attributes = new Attributes();
	}
}