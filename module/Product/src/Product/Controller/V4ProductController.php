<?php
namespace Product\Controller;

use Mock\Mvc\Controller\RestfulController;
use Product\Schema\Summary;

class V4ProductController extends RestfulController {
	
	public function get($id){
		/*
		$x = new Summary();
		$y = $this->objectToArray($x);
		//$res = array("summary"=>$y);
		$res = array("summary"=>$id);
		*/
		$as = $this->getServiceLocator()->get('V4Product\Assembler');
		$as->parseOptions($id['options']);
		$res = $as->getResponse();
		return $this->mockModel($res);
	}
	

	
	
	
	protected function getIdentifier($routeMatch, $request)
	{
		$id = $routeMatch->getParam('id', false);
		$options = $routeMatch->getParam('options',false);
		if($id && $options){
			return array('id'=>$id, 'options'=>$options);
		}
		if ($id) {
			return $id;
		}
	
		$id = $request->getQuery()->get('id', false);
		if ($id) {
			return $id;
		}
	
		return false;
	}
	
	
	protected   function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
	
		if (is_array($d)) {
			/*
				* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(array(__CLASS__,__FUNCTION__), $d);
		}
		else {
			// Return array
			return $d;
		}
	}
}