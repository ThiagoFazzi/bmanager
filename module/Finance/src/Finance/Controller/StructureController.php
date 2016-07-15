<?php
namespace Finance\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel; 
use Finance\Entity\Structure;
//use Finance\Entity\Bank;
use Finance\Form\StructureForm;
//use Finance\Validator\BankValidator;

class StructureController extends AbstractActionController {

	protected $serviceLocator = null;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
    
    public function getServiceLocator() {
        return $this->serviceLocator;
    }	

	
	public function registerAction() {
	
		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}
		
		$form = new StructureForm();

		return new ViewModel(['form' => $form]);
	}

	public function createStructAction() {

		//$id = $this->params()->fromRoute('id');
		//if(is_null($id)){
		//	$id = $this->params()->fromPost('id');
		//}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

		$StructureRepository = $entityManager->getRepository('Finance\Entity\Structure');
		$items = $StructureRepository->getStructItems();

		return new JsonModel($items);
		
	}

}