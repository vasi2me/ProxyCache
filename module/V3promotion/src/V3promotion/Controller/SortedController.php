<?php

namespace V3promotion\Controller;

use Zend\Json\Exception\RuntimeException as JsonRuntimeException;



use Zend\Stdlib\RequestInterface as Request;

use Zend\Json\Json;

use Zend\View\Model\JsonModel;

use Zend\Mvc\Controller\AbstractRestfulController;




class SortedController extends AbstractRestfulController {

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
"sortedpromotions" : [
        {
	"fob": "Men",
	"promotions" : [
	     {
            "promotionName":"TREAT YOURSELF",
            "description":"EXTRA 10% OFF select depts",
            "effectiveDay":4,
            "effectiveMonth":4,
            "effectiveYear":2008,
            "expirationDay":26,
            "expirationMonth":7,
            "expirationYear":2013,
            "global":false,
            "legalDisclaimer":"This is the small print",
            "promoId":"7503",
            "promotionCode":"P0001123",
            "promotionCodeIds":[
               "2019"
            ],
            "promotionSource":[
               "MACYS",
               "BLOOMIES"
            ],
"PromotionAttributeDTO":[
            {"promotionID":"1002","promotionAttributeName":"PROMO_HEADER","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"TREAT YOURSELF"}}}
,
{"promotionID":"1002","promotionAttributeName":"PROMO_SUB_HEADER","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"ENJOY 15% OFF"}
}
},
{"promotionID":"1002","promotionAttributeName":"PROMO_SUB_DESCRIPTION","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"EXTRA 10% OFF select depths."}
}
},
{"promotionID":"1002","promotionAttributeName":"PROMO_SUB_DESCRIPTION2","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"exclusion apply.online only."}
}
},
{"promotionID":"1002","promotionAttributeName":" PROMO_CLICK_THROUGH_URL","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"http://m.macys.com/shop/mens-clothing/mens-activewear?id=3296&edge=hybrid#!fn=sortBy%3DORIGINAL%26productsPerPage%3D20&!qvp=iqvp%26!fn=sortBy%3DORIGINAL&!qvp=iqvp"}
}
}
],
            "promotionSourceCode":"D",
            "promotionType":"SUPC Percent Off Order"
         },
	{
            "promotionName":"Promo 2",
            "description":"Enjoy 20% off your $100 purchase.",
            "effectiveDay":26,
            "effectiveMonth":5,
            "effectiveYear":2008,
            "expirationDay":0,
            "expirationMonth":0,
            "expirationYear":0,
            "global":false,
            "legalDisclaimer":"This is the small print",
            "promoId":"7503",
            "promotionCode":"X00867_0050000",
            "promotionCodeIds":[
               "2019"
            ],
            "promotionSource":[
               "MACYS",
               "BLOOMIES"
            ],
"PromotionAttributeDTO":[
            {"promotionID":"1002","promotionAttributeName":"PROMO_HEADER","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"FREE SHIPPING"}}}
,
{"promotionID":"1002","promotionAttributeName":"PROMO_SUB_HEADER","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"EVERY DAY"}
}
},
{"promotionID":"1002","promotionAttributeName":"PROMO_SUB_DESCRIPTION","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"Free shipping applied at checkout."}
}
},
{"promotionID":"1002","promotionAttributeName":"PROMO_SUB_DESCRIPTION2","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"US shipping only. exclusions apply."}
}
},
{"promotionID":"1002","promotionAttributeName":" PROMO_CLICK_THROUGH_URL","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"http://m.macys.com/shop/mens-clothing/mens-activewear?id=3296&edge=hybrid#!fn=sortBy%3DORIGINAL%26productsPerPage%3D20&!qvp=iqvp%26!fn=sortBy%3DORIGINAL&!qvp=iqvp"}
}
}
],

            "promotionSourceCode":"D",
            "promotionType":"SUPC Percent Off Order"
         }
	]
   },
  {
	"fob": "WOMEN",
	"promotions": [
	     {
            "promotionName":"Promo 3",
            "description":"Enjoy 20% off your $100 purchase.",
            "effectiveDay":26,
            "effectiveMonth":5,
            "effectiveYear":2008,
            "expirationDay":17,
            "expirationMonth":9,
            "expirationYear":2013,
            "global":false,
            "legalDisclaimer":"This is the small print",
            "promoId":"7503",
            "promotionCode":"VIP",
            "promotionCodeIds":[
               "2019"
            ],
            "promotionSource":[
               "MACYS",
               "BLOOMIES"
            ],
             "PromotionAttributeDTO":[
            {"promotionID":"1005","promotionAttributeName":"PROMO_HEADER","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"VIP SALE ENJOY 20% OFF"}}}
,

{"promotionID":"1005","promotionAttributeName":"PROMO_SUB_DESCRIPTION","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"Extra  15% OFF selects depts"}
}
},
{"promotionID":"1005","promotionAttributeName":"PROMO_SUB_DESCRIPTION2","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"exclusion apply."}
}
},
{"promotionID":"1005","promotionAttributeName":" PROMO_CLICK_THROUGH_URL","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"http://m.macys.com/shop/womens-clothing/womens-coats?id=269&edge=hybrid#!fn=sortBy%3DORIGINAL%26productsPerPage%3D20&!qvp=iqvp"}
}
}
],
            "promotionSourceCode":"D",
            "promotionType":"SUPC Percent Off Order",
            "coupon":{
               "couponDescription":"EXTRA 10% OFF select depths",
               "couponEffectiveDay":"04",
               "couponEffectiveMonth":"04",
               "couponEffectiveYear":"2013",
               "couponExpirationDay":"26",
               "couponExpirationMonth":"07",
               "couponExpirationYear":"2013",
               "couponHeading":"TREAT YOURSELF",
               "couponNumber":"00014906100318241415\n",
               "couponShortCode":"VETSLP",
               "couponSubHeading":"Three Flags in One",
               "couponType":"Search Marketing",
               "couponURL":"http://www.macys.com/cms/deals/SUPER_SATURDAY_Sale_20percent_off_W3040169wis",
               "displayEndDate":"2014-11-11T00:00:00-05:00",
               "displayStartDate":"2012-11-11T00:00:00-05:00",
               "couponAttributes":[{"attributeName":"COUPON_META_DESCRIPTION","attributeValue":"WOMEN"},{"attributeName":"CPN_PASSBOOK_URL","attributeValue":"http:\/\/d16rliti0tklvn.cloudfront.net\/379\/passbook\/1364832675.pkpass"}]
            }
         },
	{
            "promotionName":"Promo 4",
            "description":"Enjoy 20% off your $100 purchase.",
            "effectiveDay":26,
            "effectiveMonth":5,
            "effectiveYear":2008,
            "expirationDay":26,
            "expirationMonth":12,
            "expirationYear":2013,
            "global":false,
            "legalDisclaimer":"This is the small print",
            "promoId":"7503",
            "promotionCode":"X00867_0050000",
            "promotionCodeIds":[
               "2019"
            ],
            "promotionSource":[
               "MACYS",
               "BLOOMIES"
            ],
            "PromotionAttributeDTO":[
            {"promotionID":"1002","promotionAttributeName":"PROMO_HEADER","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"THE GREAT SHORTS SALE"}}}
,
{"promotionID":"1002","promotionAttributeName":"PROMO_SUB_HEADER","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"TAKE 20% OFF"}
}
},
{"promotionID":"1002","promotionAttributeName":"PROMO_SUB_DESCRIPTION","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"When you buy 2 or more"}
}
},
{"promotionID":"1002","promotionAttributeName":"PROMO_SUB_DESCRIPTION2","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"of womens shorts"}
}
},
{"promotionID":"1005","promotionAttributeName":" PROMO_CLICK_THROUGH_URL","attributeSeqNumber":"1","attributeValue":{"PromotionAttributeValueDTO":{"promotionID":"0","attributeValueSeqNumber":"0","attributeValue":"http://m.macys.com/shop/womens-clothing/womens-shorts?id=5344&edge=hybrid#!fn=sortBy%3DORIGINAL%26productsPerPage%3D20&!qvp=iqvp"}
}
}

],
            "promotionSourceCode":"D",
            "promotionType":"SUPC Percent Off Order",
            "coupon":{
               "couponDescription":"10% of British Flags",
               "couponEffectiveDay":"10",
               "couponEffectiveMonth":"12",
               "couponEffectiveYear":"2013",
               "couponExpirationDay":"15",
               "couponExpirationMonth":"12",
               "couponExpirationYear":"2013",
               "couponHeading":"Union Jacks Coupon",
               "couponNumber":"00014906100318241415\n",
               "couponShortCode":"VETSLP",
               "couponSubHeading":"Three Flags in One",
               "couponType":"Search Marketing",
               "couponURL":"http://www.macys.com/cms/deals/SUPER_SATURDAY_Sale_20percent_off_W3040169wis",
               "displayEndDate":"2014-11-11T00:00:00-05:00",
               "displayStartDate":"2012-11-11T00:00:00-05:00",
               "couponAttributes":[{"attributeName":"COUPON_META_DESCRIPTION","attributeValue":"WOMEN"},{"attributeName":"CPN_PASSBOOK_URL","attributeValue":"http:\/\/d16rliti0tklvn.cloudfront.net\/379\/passbook\/1364832675.pkpass"}]
            }
         }
	]
   }
]
}';
return json_decode($data, true);
	}
	
}
