<?php

namespace V3promotion\Controller;

use Zend\Json\Exception\RuntimeException as JsonRuntimeException;



use Zend\Stdlib\RequestInterface as Request;

use Zend\Json\Json;

use Zend\View\Model\JsonModel;

use Zend\Mvc\Controller\AbstractRestfulController;




class ShareController extends AbstractRestfulController {

	protected $notImplemented = array("success"=>false, "message"=> "Functionality Not implemented", "errors"=> array("message"=>"Not Implemented"));

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
			//$arr = XmlDecoder::fromXml($request->getContent());
			return $this->create(array());
		}
		// if we cannot handle it give it back to Framework if latest one might handle it;
		return parent::processPostData($request);
	}


	public function get($id){
		$this->getResponse()->setStatusCode(501);
		return new JsonModel($this->notImplemented);
	}

	public function getList(){
		$this->getResponse()->setStatusCode(501);
		return new JsonModel($this->notImplemented);
	}

	public function create($data){
		try {
			$validator = $this->getServiceLocator()->get('Mock\Service\JsonValidator');
			$cofig = $this->getServiceLocator()->get('config');
			$schema = $cofig['schema'];
			$default_data = $cofig['default_data'];
			if(array_key_exists('v3/promotions/share_request', $schema)){
				$validator->setSchemaFileLocation($schema['v3/promotions/share_request']);
			}
			$rdata = array();
			$validator->validate($data);
			if($validator->isValid()) {
				$this->getResponse()->setStatusCode(200);
				if(array_key_exists('v3/promotions/share_response', $default_data)){
					//$rdata =  json_encode(file_get_contents($default_data['v3/promotions/share_response']));
					$rdata = Json::decode('{"promotionsShareOfferPOSTResponse": [{"success": "true","error": "success"}]}',Json::TYPE_OBJECT);
				}
				
			}
			else {
				$this->getResponse()->setStatusCode(400);
				//if(array_key_exists('v3/promotions/share_error_response', $default_data)){
					//$rdata =  json_encode(file_get_contents($default_data['v3/promotions/share_error_response']));
					$rdata =  Json::decode('{"promotionsShareOfferPOSTResponse": [{	"success": "true","error": "success"} ]	}',Json::TYPE_OBJECT);
						
				//}
			}

		} catch (\Exception $e) {
			$this->getResponse()->setStatusCode(500);
			$rdata = array("success"=>false, "message"=>"Unable to process", "errors"=> "Application Exception Occured while processing");
		}
		return new JsonModel($rdata);
	}

	public function update($id, $data){
		$this->getResponse()->setStatusCode(501);
		return new JsonModel($this->notImplemented);
	}

	public function delete($id){
		$this->getResponse()->setStatusCode(501);
		return new JsonModel($this->notImplemented);
	}


	private function getData(){
		$data = '';
		return json_decode($data, true);;
	}

}
