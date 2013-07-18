<?php
namespace Product\Schema\Shipping;



class Shipping {

	//type="xs:string" minOccurs="0"  maxOccurs="unbounded"/> <!--Array-->
	public $excludedStates = array ("CA", "WA", "NY");
	public $shippingMethods = array ("G","A","S");
	public $returnConstraint = array ("Un Used", "15 days");
	public $notes = array ("Note 1", "Note 2");
	public $giftWrappable = true;
	public $giftMessageable = false;
		
	public $giftcode = "NO CODE";
	public $giftdescription = "For wedding";
	public $giftcost = 8.50;
	public $giftavailable = false;
	 


}