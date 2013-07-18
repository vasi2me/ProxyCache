<?php
namespace Product\Schema;

use Product\Schema\Summary\Summary as ProductSummary;

class Summary extends GenericFactory {
	
	public $summary;
	
	public function __construct(){
		$this->summary = new ProductSummary();
	}
	
}

