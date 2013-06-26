<?php
namespace Order\Controller;

use Zend\Json\Exception\RuntimeException as JsonRuntimeException;



use Zend\Stdlib\RequestInterface as Request;

use Zend\Json\Json;

use Zend\View\Model\JsonModel;
use Zend\View\Model\FeedModel;
use AP_XmlStrategy\View\Model\XmlModel;

use Zend\Mvc\Controller\AbstractRestfulController;

use Mock\Service\XmlDecoder;


class SingleUsePromoCodeController extends AbstractRestfulController {

	protected $notImplemented = array("success"=>false, "errors"=> "Functionality Not implemented");

	protected $acceptCriteria = array(
			'Zend\View\Model\JsonModel' => array(
					'application/json',
			),
			'Zend\View\Model\FeedModel' => array(
					'application/rss+xml',
			),
			'AP_XmlStrategy\View\Model\XmlModel' => array(
					'application/xml',
			),
	);


	/**
	 * Process post data and call create
	 * else pass it to framework
	 * @param Request $request
	 * @return mixed
	*/
	public function processPostData(Request $request)
	{
		$contentType = $request->getHeaders('Content-Type')->getFieldValue();
		if ($contentType == 'application/json') {
			try {
				$jsonObj = Json::decode($request->getContent(), Json::TYPE_OBJECT);
			} catch (JsonRuntimeException $e) {
				return $this->sendJsonException($e->getMessage());
			}
			return $this->create($jsonObj);
		}
		if($contentType == 'application/xml'){
			// TEMP solution till Zf2 Xml Statregy is implemented
			$arr = XmlDecoder::fromXml($request->getContent());
			return $this->create($arr);
		}
		// if we cannot handle it give it back to Framework if latest one might handle it;
		return parent::processPostData($request);
	}

	protected function processBodyContent( $request) {
		$contentType = $request->getHeaders('Content-Type')->getFieldValue();
		if ($contentType == 'application/json') {
			try {
				$jsonObj = Json::decode($request->getContent(), Json::TYPE_OBJECT);
			} catch (JsonRuntimeException $e) {
				return $this->sendJsonException($e->getMessage());
			}
			return $jsonObj;
		}
		if($contentType == 'application/xml'){
			// TEMP solution till Zf2 Xml Statregy is implemented
			$arrayrequest =   XmlDecoder::fromXml($request->getContent());
			return $this->array_to_object($arrayrequest)->request;
		}
		// if we cannot handle it give it back to Framework if latest one might handle it;
		return parent::processBodyContent($request);


	}

	/* Override the PUT functinoality */
	protected function getIdentifier($routeMatch, $request)
	{
		$method = strtolower($request->getMethod());
		if($method == 'put' || $method == 'delete') {
			return 1;
		}
		else {
			return parent::getIdentifier($routeMatch, $request);
		}
	}


	public function get($id){
		$this->getResponse()->setStatusCode(400);
		return $this->outModel($this->notImplemented);
	}

	public function getList(){
		$this->getResponse()->setStatusCode(400);
		$res = $this->notImplemented;
		return $this->outModel($res);
	}



	public function create($data){
		$this->getResponse()->setStatusCode(400);
		$res = $this->notImplemented;
		return $this->outModel($res);
	}

	public function update($id, $data){
		
		$rdata = array("success"=>false,"errorCode"=>500, "errorMessage"=> "Application Exception Occured while processing");
		try {
			$validator = $this->getServiceLocator()->get('Mock\Service\JsonValidator');
			$cofig = $this->getServiceLocator()->get('config');
			$schema = $cofig['schema'];
				
			if(array_key_exists('v3/order/supc', $schema)){
				$validator->setSchemaFileLocation($schema['v3/order/supc']);
			}
			
			$validator->validate($data);
			if($validator->isValid()) {
				//$this->getResponse()->setStatusCode(200);
				if($data->reservationId < 1000){
					$this->getResponse()->setStatusCode(400);
					$rdata = array("success"=>false, "errorCode"=> 400, "errorMessage" => "Error processing request: INVALID_CODE");
				}
				else if($data->promoCode == "DUMMY"){
					$this->getResponse()->setStatusCode(400);
					$rdata = array("success"=>false, "errorCode"=> 400, "errorMessage" => "Error processing request: ALREADY_USED");
				}
				else if($data->orderNumber == "DUMMY"){
					$this->getResponse()->setStatusCode(500);
					$rdata = array("success"=>false, "errorCode"=> 500, "errorMessage" => "Error processing request: SYSTEM_ERROR");
				}
				else if($data->status != "EXPIRE"){
					$this->getResponse()->setStatusCode(400);
					$rdata = array("success"=>false, "errorCode"=> 400, "errorMessage" => "Error processing request:  INVALID_CODE, status value should be EXPIRE");
				}
				else {
				$rdata = array("success"=>true);
				}
			}
			else {
				$this->getResponse()->setStatusCode(400);
				$rdata = array("success"=>false,"errorCode"=>400, "errorMessage"=> $validator->getErrorAsString());
			}

		} catch (\Exception $e) {
			$this->getResponse()->setStatusCode(500);
			$rdata = array("success"=>false,"errorCode"=>500, "errorMessage"=> "Application Exception Occured while processing " . $e->getTraceAsString());
		}
		return $this->outModel($rdata);
	}

	public function delete($id){
		$this->getResponse()->setStatusCode(400);
		$res = $this->notImplemented;
		return $this->outModel($res);
	}


	
	private function outModel($data){
		$viewModel = $this->acceptableViewModelSelector($this->acceptCriteria);
		if ($viewModel instanceof JsonModel) {
			return new JsonModel($data);
		}
		
		if ($viewModel instanceof FeedModel) {
			return new FeedModel($data);
		}
		
		if ($viewModel instanceof XmlModel){
			return new XmlModel($data);
		}
	}

	private function array_to_object($array) {
		$obj = new \stdClass();
		foreach($array as $k => $v) {
			if(strlen($k)) {
				if(is_array($v)) {
					$obj->{$k} = $this->array_to_object($v); //RECURSION
				} else {
					$obj->{$k} = $v;
				}
			}
		}
		return $obj;
	}
	
}