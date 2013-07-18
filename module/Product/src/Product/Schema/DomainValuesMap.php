<?php
namespace Product\Schema ;



class DomainValuesMap extends GenericFactory  {

	public $domainValuesMap ;

	public function __construct(){
		$this->domainValuesMap = array(new DomainValueMap\DomainValue());
	}
}