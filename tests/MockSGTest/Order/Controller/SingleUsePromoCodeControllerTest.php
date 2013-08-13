<?php
namespace MockSGTest\Order\Controller;


use MockSGTest\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Order\Controller\SingleUsePromoCodeController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Http\Headers;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;


class IndexControllerTest extends \PHPUnit_Framework_TestCase {
	
	
	protected $controller;
	protected $request;
	protected $response;
	protected $routeMatch;
	protected $event;
	
	protected function setUp()
	{
		$serviceManager = Bootstrap::getServiceManager();
		$this->controller = new SingleUsePromoCodeController();
		$this->request    = new Request();
		$this->routeMatch = new RouteMatch(array('controller' => 'index'));
		$this->event      = new MvcEvent();
		$config = $serviceManager->get('Config');
		$routerConfig = isset($config['router']) ? $config['router'] : array();
		$router = HttpRouter::factory($routerConfig);
	
		$this->event->setRouter($router);
		$this->event->setRouteMatch($this->routeMatch);
		$this->controller->setEvent($this->event);
		$this->controller->setServiceLocator($serviceManager);
	}
	
	public function testGetListCanBeAccessed()
	{
		$result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
 
        $this->assertEquals(400, $response->getStatusCode());
	
		
	}
	
	public function testGetCanBeAccessed()
	{
		$this->routeMatch->setParam('id', '1');
	
		$result   = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();
	
		$this->assertEquals(400, $response->getStatusCode());
	}
	
	
	public function testCreateCanBeAccessed()
	{
		$this->request->setMethod('post');
		//$this->request->setHeaders($headers)
		$this->request->getPost()->set('artist', 'foo');
		$this->request->getPost()->set('title', 'bar');
	
		$result   = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();
	
		$this->assertEquals(400, $response->getStatusCode());
	}
	
	public function testUpdateCanBeAccessed()
	{
		$this->routeMatch->setParam('id', '1');
		$this->request->setMethod('put');
		$this->request->getHeaders()->addHeaders(array(
				'Content-Type' => 'application/json',
		));
		
		$this->request->setContent('{"promoCode":"XOPXIOPIDIFGDIFGIDPFIGPDFIPGIDPFOG234","orderNumber": "12365465","reservationId": "2141","status": "EXPIRE"}');
		$result   = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();
	
		$this->assertEquals(500, $response->getStatusCode());
	}
	
	
	public function testDeleteCanBeAccessed()
	{
		$this->routeMatch->setParam('id', '1');
		$this->request->setMethod('delete');
	
		$result   = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();
	
		$this->assertEquals(400, $response->getStatusCode());
	}
}