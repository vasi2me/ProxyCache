<?php
namespace Product\Schema ;



class  ProductCategory  extends GenericFactory  {

	public $productCategory ;

	public function __construct(){
		$this->productCategory  = array(new ProductCategory\ProductCategory(), new ProductCategory\ProductCategory()) ;
	}
}