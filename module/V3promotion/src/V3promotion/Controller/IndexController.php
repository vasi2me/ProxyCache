<?php

namespace V3promotion\Controller;

use Zend\Json\Exception\RuntimeException as JsonRuntimeException;



use Zend\Stdlib\RequestInterface as Request;

use Zend\Json\Json;

use Zend\View\Model\JsonModel;

use Zend\Mvc\Controller\AbstractRestfulController;




class IndexController extends AbstractRestfulController {

	protected $notImplemented = array("success"=>false, "message"=> "Functionality Not implemented", "errors"=> array("message"=>"Not Implemented"));
	
	public function get($id){
		$this->getResponse()->setStatusCode(501);
		return new JsonModel($this->notImplemented);
	}

	public function getList(){
		$this->getResponse()->setStatusCode(200);
		
		
		
		return new JsonModel($this->getData());
	}

	public function create($data){
		try {
			

				$this->getResponse()->setStatusCode(202);
				$rdata =  array( 'success'=> true,
						"message"=>"Automation Result captured and Processed",
				);

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
		$data = '{
    "promotionDetailsResponse": [
        {
            "Men": [
                {
                    "promotionName": "Buy Jeans for $100",
                    "description": "Mens Jeans Offer",
                    "global": "true",
                    "promoId": "1001",
                    "legalDisclaimer": "Legal Disclaimer",
                    "offerDescription": "Mens Jeans Offer",
                    "promotionType": "Dollor Off Order",
                    "effectiveDay": 26,
                    "effectiveMonth": 5,
                    "effectiveYear": 2008,
                    "expirationDay": 26,
                    "expirationMonth": 5,
                    "expirationYear": 2013,
                    "promotionCode": "X00867_0050000",
                    "promotionCodeIds": [
                        "2019"
                    ],
                    "promotionSources": [
                        "MACYS"
                    ],
                    "promotionSourceCode": "D",
                    "PromotionAttributeDTO": [
                        {
                            "promotionID": "1002",
                            "promotionAttributeName": "FOB",
                            "attributeSeqNumber": "1",
                            "attributeValue": {
                                "PromotionAttributeValueDTO": {
                                    "promotionID": "0",
                                    "attributeValueSeqNumber": "0",
                                    "attributeValue": "WOMEN"
                                }
                            }
                        }
                    ],
                    "coupon": {
                        "couponUrl": "http://www1.macys.com/cms/deals/MORE_CHOICES_Sale_15percent_off_W3030173",
                        "couponHeading": "Union Jacks Coupon",
                        "couponSubHeading": "Three Flags in One",
                        "CouponDescription": "EXTRA COUPON",
                        "couponShortCode": "EXTRAMOR",
                        "couponNumber": "1234",
                        "couponType": "Search Marketing",
                        "couponeffectiveDay": 26,
                        "couponeffectiveMonth": 5,
                        "couponeffectiveYear": 2008,
                        "couponexpirationDay": 26,
                        "couponexpirationMonth": 5,
                        "couponexpirationYear": 2013,
                        "displayEndDate": "2014-11-11T00:00:00-05:00",
                        "displayStartDate": "2012-11-11T00:00:00-05:00",
                        "couponAttributes": [{
                            "attributeName": "COUPON_META_DESCRIPTION",
                            "attributeValue": "WOMEN"
                        },
						{
                            "attributeName": "CPN_PASSBOOK_URL",
                            "attributeValue": "http://d16rliti0tklvn.cloudfront.net/379/passbook/1364832675.pkpass"
                        }
				]
                    }
                },
                {
                    "promotionName": "Buy Jeans for $100",
                    "description": "Mens Jeans Offer",
                    "global": "true",
                    "promoId": "1001",
                    "legalDisclaimer": "Legal Disclaimer",
                    "offerDescription": "Mens Jeans Offer",
                    "promotionType": "Dollor Off Order",
                    "effectiveDay": 26,
                    "effectiveMonth": 5,
                    "effectiveYear": 2008,
                    "expirationDay": 26,
                    "expirationMonth": 5,
                    "expirationYear": 2013,
                    "promotionCode": "X00867_0050000",
                    "promotionCodeIds": [
                        "2019"
                    ],
                    "promotionSources": [
                        "MACYS"
                    ],
                    "promotionSourceCode": "D",
                    "PromotionAttributeDTO": [
                        {
                            "promotionID": "1002",
                            "promotionAttributeName": "FOB",
                            "attributeSeqNumber": "1",
                            "attributeValue": {
                                "PromotionAttributeValueDTO": {
                                    "promotionID": "0",
                                    "attributeValueSeqNumber": "0",
                                    "attributeValue": "WOMEN"
                                }
                            }
                        },
						{
                            "promotionID": "1002",
                            "promotionAttributeName": "CLICK_THROUGH_URL",
                            "attributeSeqNumber": "1",
                            "attributeValue": {
                                "PromotionAttributeValueDTO": {
                                    "promotionID": "0",
                                    "attributeValueSeqNumber": "0",
                                    "attributeValue": "http://m.macys.com/shop/womens-clothing/womens-activewear?id=29891"
                                }
                            }
                        }
                    ]
                }
            ],
            "Women": [
                {
                    "promotionName": "Buy Jeans for $100",
                    "description": "Mens Jeans Offer",
                    "global": "true",
                    "promoId": "1001",
                    "legalDisclaimer": "Legal Disclaimer",
                    "offerDescription": "Mens Jeans Offer",
                    "promotionType": "Dollor Off Order",
                    "effectiveDay": 26,
                    "effectiveMonth": 5,
                    "effectiveYear": 2008,
                    "expirationDay": 26,
                    "expirationMonth": 5,
                    "expirationYear": 2013,
                    "promotionCode": "X00867_0050000",
                    "promotionCodeIds": [
                        "2019"
                    ],
                    "promotionSources": [
                        "MACYS"
                    ],
                    "promotionSourceCode": "D",
                    "PromotionAttributeDTO": [
                        {
                            "promotionID": "1002",
                            "promotionAttributeName": "FOB",
                            "attributeSeqNumber": "1",
                            "attributeValue": {
                                "PromotionAttributeValueDTO": {
                                    "promotionID": "0",
                                    "attributeValueSeqNumber": "0",
                                    "attributeValue": "WOMEN"
                                }
                            }
                        }
                    ]
                }
            ],
            "MacysOffers": [
                {
                    "promotionName": "Buy Jeans for $100",
                    "description": "Mens Jeans Offer",
                    "global": "true",
                    "promoId": "1001",
                    "legalDisclaimer": "Legal Disclaimer",
                    "offerDescription": "Mens Jeans Offer",
                    "promotionType": "Dollor Off Order",
                    "effectiveDay": 26,
                    "effectiveMonth": 5,
                    "effectiveYear": 2008,
                    "expirationDay": 26,
                    "expirationMonth": 5,
                    "expirationYear": 2013,
                    "promotionCode": "X00867_0050000",
                    "promotionCodeIds": [
                        "2019"
                    ],
                    "promotionSources": [
                        "MACYS"
                    ],
                    "promotionSourceCode": "D",
                    "PromotionAttributeDTO": [
                        {
                            "promotionID": "1002",
                            "promotionAttributeName": "FOB",
                            "attributeSeqNumber": "1",
                            "attributeValue": {
                                "PromotionAttributeValueDTO": {
                                    "promotionID": "0",
                                    "attributeValueSeqNumber": "0",
                                    "attributeValue": "WOMEN"
                                }
                            }
                        }
                    ]
                }
            ]
        }
    ]
}';
return json_decode($data, true);;
	}
	
}
