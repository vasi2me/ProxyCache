<?php
namespace Akamai\Controller;



use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;

class ServerController extends AbstractActionController {
	
	private $WSDL = 'http://L4488129:83/soap/servlet/soap/purge?wsdl';
	
	public function indexAction(){
		/*
		* Checks for passing the url parameter the wsdl
		* Goes the parameter accessed function handleWSDL
		* And load the functions, it will return the WSDL
		*/
		if (isset ( $_GET [ 'wsdl' ])) {
			$this->handleWSDL ();
		} else {
			
			$this->handleSOAP ();
		}
		
		$View = new ViewModel ();
		$View->setTerminal (true);
		exit ();
	}
	
	protected function handleWSDL(){
		$autodiscover = new AutoDiscover ();
		
		/**
		* We create a new directory called the Service and create a class OlaMun the
		* Then we set the class in the autodiscover meto the SetClass
		*/
		$autodiscover -> SetClass ( '\Akamai\Server\PurgeApi' );
		
		// We set the Uri return without the parameter? WSDL
		$autodiscover->setUri( 'http://L4488129:83/soap/servlet/soap/purge' );
		$wsdl = $autodiscover->generate ();
		$wsdl = $wsdl->toDomDocument ();
		
		// Generate the XML dan the one echo the $ wsdl -> saveXML ()
		echo  $wsdl->saveXML();
	}
	
	public  function handleSOAP () {
		
		$soap = new Server ( $this->WSDL);
	
		/**
		* We create a new directory called the Service and create a class OlaMun the
		* Then we set the class in the autodiscover meto the SetClass
		*/
		$soap->SetClass ( '\Akamai\Server\PurgeApi' );
	
		// Takes ordered from  the standard input stream
		$soap->handle ();
	}
}