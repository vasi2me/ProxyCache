<?php
namespace Mock\Mvc\Controller;

use Zend\Json\Exception\RuntimeException as JsonRuntimeException;
use Zend\Json\Exception\RecursionException as JsonRecursionException;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Json\Json;
use Zend\View\Model\JsonModel;
use Zend\View\Model\FeedModel;
use AP_XmlStrategy\View\Model\XmlModel;
use Zend\Mvc\Controller\AbstractRestfulController;
use Mock\Service\XmlDecoder;

/**
 * Gives flexibility to write the required HTTP methods only and rest all can be
 * left without implemenation for our MOCKing framework
 * @author YC30V1M
 *
 *Hence by this we reduce the API Mock dev time and fix global errors easily
 *and DRY easily
 */

class RestfulController extends AbstractRestfulController {
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
		if($decodedReq = $this->decodeByContentType($request)) {
			// Yup we know the format we will call POST -> create function map
			// Calling Create function
			return $this->create($decodedReq);
		}
		else {
			// if we cannot handle it give it back to Framework if latest one might handle it;
			return parent::processPostData($request);
		}
	}

	protected function processBodyContent($request) {
		if($decodedReq = $this->decodeByContentType($request)) {
			return $decodedReq;
		}
		else {
			// if we cannot handle it give it back to Framework if latest one might handle it;
			return parent::processBodyContent($request);
		}
	}


	private function decodeByContentType($request){
		$contentType = $request->getHeaders('Content-Type')->getFieldValue();
		if ($contentType == 'application/json') {
			try {
				$jsonObj = Json::decode($request->getContent(), Json::TYPE_OBJECT);
			} catch (JsonRuntimeException $e) {
				return $this->sendJsonException($e->getMessage());
			}
			return $jsonObj;
		}
		else if($contentType == 'application/xml'){
			try {
				// TEMP solution till Zf2 Xml Statregy is implemented
				$arrayrequest =   XmlDecoder::fromXml($request->getContent());
				return $this->arrayToObject($arrayrequest)->request;

			} catch (JsonRecursionException $e) {
				return $this->sendJsonException($e->getMessage());
			} catch (JsonRuntimeException $e){
				return $this->sendJsonException($e->getMessage());
			}
		}
		return false;
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
		$res = $this->notImplemented;
		return $this->mockModel($res);
	}

	public function getList(){
		$this->getResponse()->setStatusCode(400);
		$res = $this->notImplemented;
		return $this->mockModel($res);
	}



	public function create($data){
		$res = $this->notImplemented;
		try {
			$this->getResponse()->setStatusCode(400);
		} catch (\Exception $e) {
			$this->getResponse()->setStatusCode(500);
			$res = array("success"=>false,"errorCode"=>500, "errorMessage"=> "Application Exception Occured while processing " . $e->getTraceAsString());
		}
		return $this->mockModel($res);
	}

	public function update($id, $data){
		$this->getResponse()->setStatusCode(400);
		$rdata = $this->notImplemented;
		return $this->mockModel($rdata);
	}

	public function delete($id){
		$this->getResponse()->setStatusCode(400);
		$res = $this->notImplemented;
		return $this->mockModel($res);
	}



	protected function mockModel($data){
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

	private function arrayToObject($array) {
		$obj = new \stdClass();
		foreach($array as $k => $v) {
			if(strlen($k)) {
				if(is_array($v)) {
					$obj->{$k} = $this->arrayToObject($v); //RECURSION
				} else {
					$obj->{$k} = $v;
				}
			}
		}
		return $obj;
	}


	protected function sendJsonException($e){
		$this->getResponse()->setStatusCode(500);
		$rdata = array("success"=>false, "message"=>"Unable to process", "errors"=> $e
		);
		return new JsonModel($rdata);
	}
}