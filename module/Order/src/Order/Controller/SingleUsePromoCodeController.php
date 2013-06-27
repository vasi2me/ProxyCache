<?php
namespace Order\Controller;

use Mock\Mvc\Controller\RestfulController;


class SingleUsePromoCodeController extends RestfulController {

	/**
	 * /v3/order/supc put service for MSA
	 * @see \Mock\Mvc\Controller\RestfulController::update()
	 */
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
				if($data->reservationId < 1000 || $data->reservationId == null){
					$this->getResponse()->setStatusCode(400);
					$rdata = array("success"=>false, "errorCode"=> 400, "errorMessage" => "Error processing request: INVALID_CODE");
				}
				else if($data->promoCode == "DUMMY" || $data->promoCode == ""){
					$this->getResponse()->setStatusCode(400);
					$rdata = array("success"=>false, "errorCode"=> 400, "errorMessage" => "Error processing request: ALREADY_USED");
				}
				else if($data->orderNumber == "DUMMY" || $data->orderNumber == ""){
					$this->getResponse()->setStatusCode(500);
					$rdata = array("success"=>false, "errorCode"=> 500, "errorMessage" => "Error processing request: SYSTEM_ERROR");
				}
				else if($data->status != "EXPIRE" ){
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
		return $this->mockModel($rdata);
	}

}