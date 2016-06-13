<?php
namespace Commercial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BudgetController extends AbstractActionController {

	public function indexAction() {

		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}
		
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

		$repository = $entityManager->getRepository('Commercial\Entity\Budget');

		$budgets = $repository->findALL();

		$view_params = array(
			'budgets' => $budgets
		);

		
		return new ViewModel($view_params);
	}

	public function listAction() {
	
		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		return new ViewModel();

	}	

}