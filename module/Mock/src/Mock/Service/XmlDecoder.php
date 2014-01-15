<?php
namespace Mock\Service;

/**
 * This is a Intermidate solution to Accept XML for the Requests, 
 * HOwever we will only give back JSON in response by this,
 * Waiting for Zf2 2.1.0 to have XML statergy implemented
 */

use Zend\Json\Json;
use SimpleXMLElement;
use Zend\Json\Exception\RecursionException;
use Zend\Json\Exception\RuntimeException;

class XmlDecoder extends Json {

	/**
	 * Modified the function of JSON to only genreate PHP ARRAY as we need that on only
	 * @param unknown $xmlStringContents
	 * @param string $ignoreXmlAttributes
	 * @throws RuntimeException
	 * @return unknown
	 */
	public static function fromXml ($xmlStringContents, $ignoreXmlAttributes=true)
	{
		// Load the XML formatted string into a Simple XML Element object.
		$simpleXmlElementObject = simplexml_load_string($xmlStringContents);
	
		// If it is not a valid XML content, throw an exception.
		if ($simpleXmlElementObject == null) {
			throw new RuntimeException('Function fromXml was called with an invalid XML formatted string.');
		} // End of if ($simpleXmlElementObject == null)
	
		$resultArray = null;
	
		// Call the recursive function to convert the XML into a PHP array.
		$resultArray = static::_processXml($simpleXmlElementObject, $ignoreXmlAttributes);
	
		// Convert the PHP array to JSON using Zend_Json encode method.
		// It is just that simple.
		return $resultArray;
	}
	
}