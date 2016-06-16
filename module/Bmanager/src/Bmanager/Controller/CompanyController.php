<?php
namespace Bmanager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CompanyController extends AbstractActionController {

	public function indexAction() {

		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$companyRepository = $entityManager->getRepository('Bmanager\Entity\Company');
		$companys = $companyRepository->findALL();

		$view_params = array(
			'companys' => $companys,
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