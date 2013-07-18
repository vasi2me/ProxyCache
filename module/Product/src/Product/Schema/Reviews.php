<?php
namespace Product\Schema ;



class Reviews  extends GenericFactory  {

	public $reviews ;

	public function __construct(){
		$this->reviews["summary"]  = new Review\Summary();
		$this->reviews["details"] = array (new Review\Detail(), new Review\Detail());
 	}
}