<?php

namespace Application\Controller;

use Application\Database\Entity\Configs;

use Application\Form\ConfigForm;

use Zend\View\Model\ViewModel;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController {

	public function indexAction() {
		$config = $this->getServiceLocator()->get('Database\Configs');
		
		return new ViewModel(array(
				'configs' => $config->fetchAll(),
		));
	}
	
	protected function getConfigTable()
	{
		return $this->getServiceLocator()->get('Database\Configs');
	}

	public function addAction(){
		
		$form = new ConfigForm();
		$form->get('submit')->setValue('Add');
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$config = new Configs();
			//$form->setInputFilter($config->getInputFilter());
			$form->setData($request->getPost());
		
			if ($form->isValid()) {
				//$config->exchangeArray($form->getData());
				//$config->getHydrator()->extract($form->getData());
				$d = $this->getConfigTable()->getHydrator()->hydrate($form->getData(), $config);
				$this->getConfigTable()->save($d);
		
				// Redirect to list of albums
				return $this->redirect()->toRoute('config');
			}
		}
		return array('form' => $form);
		
	}

	public function removeAction() {
	}

	public function updateAction(){
	}


}