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
<<<<<<< HEAD
		$repositorio = $entityManager->getRepository('Commercial\Entity\Budget');

		$produtos = $repositorio->findALL();

		$view_params = array(
			'produtos' => $produtos,
		);
=======
		$repository = $entityManager->getRepository('Commercial\Entity\Budget');

		$budgets = $repository->findALL();

		$view_params = array(
			'budgets' => $budgets
		);

		

>>>>>>> 577d844df56a9c9ec46ee3530044680e5b0420af
		return new ViewModel($view_params);
	}

	public function listAction() {
	
		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		return new ViewModel();

	}	

}