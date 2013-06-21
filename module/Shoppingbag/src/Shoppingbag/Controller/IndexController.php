<?php

namespace Shoppingbag\Controller;

use Zend\Json\Exception\RuntimeException as JsonRuntimeException;



use Zend\Stdlib\RequestInterface as Request;

use Zend\Json\Json;

use Zend\View\Model\JsonModel;
use Zend\View\Model\FeedModel;
use AP_XmlStrategy\View\Model\XmlModel;

use Zend\Mvc\Controller\AbstractRestfulController;




class IndexController extends AbstractRestfulController {

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

	public function get($id){
		$this->getResponse()->setStatusCode(201);


		return new FeedModel($this->notImplemented);
	}

	public function getList(){
		//$this->getResponse()->setStatusCode(202);
		//$this->getResponse()->setMetadata('contenttype', 'application/xml');


		$viewModel = $this->acceptableViewModelSelector($this->acceptCriteria);
		$res = $this->getData();
		if ($viewModel instanceof JsonModel) {
			return new JsonModel($res);
		}

		if ($viewModel instanceof FeedModel) {
			return new FeedModel($res);
		}

		if ($viewModel instanceof XmlModel){
			return new XmlModel($res);
		}
	}



	public function create($data){
		try {
			$this->getResponse()->setStatusCode(200);
			$rdata = $this->notImplemented;

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
		$data = '{"userid":"7428579699","bagid":"2103-64115","totalquantity":"2","merchandisetotal":"232.98","discounttotal":"95.02","totalshipmentfee":"3.25","ordertax":"13.98","total":"250.20999999999998","shippingmethod":"G","totalpersonalizationfee":"0.0","yaqfAmount":"0.0","yaqfFlag":"false","storelocnbr":"2467","bagitems":[{"itemsequencenumber":"1","upcid":"30986067","upc":"766370406926","quantity":"1","total":"129.99","retailprice":"129.99","state":"ADD","isgift":"false","mergeflag":"false","promoid":"0","customprice":"0.0","itemdiscount":"60.01","availability":"true","intermediateprice":"0.0","originalprice":"190.0","specialItem":"false","maxquantity":"6","personalizationfee":"0.0","personalizationflag":"false","pickupfromstore":"true","storeavailability":"AVAILABLE"},{"itemsequencenumber":"2","upcid":"21814099","upc":"13816575655","quantity":"1","total":"102.99","retailprice":"102.99","state":"ADD","isgift":"false","mergeflag":"false","promoid":"0","customprice":"0.0","itemdiscount":"35.01","availability":"true","intermediateprice":"0.0","originalprice":"138.0","specialItem":"false","maxquantity":"6","personalizationfee":"0.0","personalizationflag":"false","pickupfromstore":"true","storeavailability":"LIMITED"}],"store":{"storeId":"673","divisionId":"6","locationNumber":"2467","storeNumber":"101","name":"Macy\'s Dulles","phone":"703-421-4814","address":{"line1":"21060 Dulles Town Circle","line2":[],"city":"Dulles","state":"VA","countryCode":"USA","zipCode":"20166"},"workingHours":[{"date":"2013-05-29","storeopenhour":"10:00","storeclosehour":"21:30"},{"date":"2013-05-30","storeopenhour":"10:00","storeclosehour":"21:30"},{"date":"2013-05-31","storeopenhour":"10:00","storeclosehour":"22:00"},{"date":"2013-06-01","storeopenhour":"10:00","storeclosehour":"21:30"},{"date":"2013-06-02","storeopenhour":"11:00","storeclosehour":"19:00"},{"date":"2013-06-03","storeopenhour":"10:00","storeclosehour":"21:30"},{"date":"2013-06-04","storeopenhour":"10:00","storeclosehour":"21:30"},{"date":"2013-06-05","storeopenhour":"10:00","storeclosehour":"21:30"},{"date":"2013-06-06","storeopenhour":"10:00","storeclosehour":"21:30"},{"date":"2013-06-07","storeopenhour":"10:00","storeclosehour":"22:00"},{"date":"2013-06-08","storeopenhour":"10:00","storeclosehour":"21:30"},{"date":"2013-06-09","storeopenhour":"11:00","storeclosehour":"19:00"}],"attributes":[{"name":"SL_MATERNITY","values":"TRUE"},{"name":"SL_BRIDAL","values":"TRUE"},{"name":"SL_SHOPPER","values":"FALSE"},{"name":"SL_FURNITURE","values":"TRUE"},{"name":"MANAGER_NAME","values":"James Springer"},{"name":"STORE_REGION_LOCATION","values":"United States"},{"name":"SL_VISITOR","values":"FALSE"},{"name":"SL_RESTAURANT","values":"FALSE"},{"name":"STORE_LISTING_ENABLED","values":"FALSE"},{"name":"SL_MATTRESS","values":"TRUE"},{"name":"SL_THISIT","values":"TRUE"},{"name":"SL_DESIGN","values":"FALSE"}]}}';
		return json_decode($data, true);;
	}

}
