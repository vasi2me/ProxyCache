<?php
/**
 * @package AP_XmlStrategy (Zend Framework 2 Extensions)
 * @author Alessandro Pietrobelli <alessandro.pietrobelli@gmail.com>
 */

namespace AP_XmlStrategy\View\Model;

use Zend\View\Model\ViewModel;
use AP_XmlStrategy\Xml\Array2XML;
/**
 * @category   Zend
 * @package    Zend_View
 * @subpackage Model
 */
class XmlModel extends ViewModel
{
    /**
     * Xml probably won't need to be captured into a
     * a parent container by default.
     *
     * @var string
     */
    protected $captureTo = null;

    /**
     * Xml is usually terminal
     *
     * @var bool
     */
    protected $terminate = true;

    /**
     * @var string
     */
    protected $encoding = 'utf-8';

    /**
     * @var string
     */
    protected $version = '1.0';

    /**
     * @param string $encoding
     *
     * @return XmlModel
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     *
     * @return XmlModel
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }


    public function serialize()
    {
        $variables = $this->getVariables();
        
        if ($variables instanceof Traversable) {
            $variables = ArrayUtils::iteratorToArray($variables);
        }
        
        // DONT know why this causes Notice and Warning 
        //Notice:  Undefined variable: xml in <b>C:\webserver\sgmock\module\AP_XmlStrategy\src\AP_XmlStrategy\View\Model\XmlModel.php</b> on line <b>93
        //Warning:  array_walk_recursive() expects parameter 2 to be a valid callback, first array member is not a valid class name or object in <b>C:\webserver\sgmock\module\AP_XmlStrategy\src\AP_XmlStrategy\View\Model\XmlModel.php</b> on line
        /////////////
        //********* Hence commenting below line *************/ 
        //array_walk_recursive($variables, array ($xml, 'addChild'));
        // END of code

        Array2XML::init($this->version, $this->encoding);

        $xml = Array2XML::createXML('response', $variables);

        return $xml->saveXML();
    }
}