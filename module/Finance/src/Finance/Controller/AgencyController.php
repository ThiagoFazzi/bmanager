<?php
namespace Finance\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Finance\Entity\Agency;
use Finance\Form\AgencyForm;
use Finance\Validator\AgencyValidator;

class AgencyController extends AbstractActionController {

	# Method for list all agencys
	public function indexAction() {

		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$agencyRepository = $entityManager->getRepository('Finance\Entity\Agency');
		$agencys = $agencyRepository->findALL();

		$view_params = array(
			'agencys' => $agencys,
		);
		return new ViewModel($view_params);

	}

	# Method for insert agency
	public function registerAction() {
	
		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$bankRepository = $entityManager->getRepository('Finance\Entity\Bank');
		
		$form = new AgencyForm($entityManager);

		if($this->request->isPost()){
			
			$name = $this->request->getPost('name');
			$number = $this->request->getPost('number');
			$bank = $bankRepository->find($this->request->getPost('bank'));

			$agency = new Agency($name,$number);
			$agency->setBank($bank);

			$agencyValidator = new AgencyValidator();

			$form->setInputFilter($agencyValidator->getInputFilter());
			$form->setData($this->request->getPost());

			if($form->isValid()){
				
				$entityManager->persist($agency);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage('Agência cadastrada com sucesso!!');

				return $this->redirect()->toRoute('finance', array('controller' => 'Agency', 'action' => 'index'));
			}
		}

		return new ViewModel(['form' => $form]);
	}	

	# Method for update agency
	public function updateAction(){

		$id = $this->params()->fromRoute('id');
		
		if(is_null($id)){
			$id = $this->request->getPost('id');
		}	

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$agencyRepository = $entityManager->getRepository('Finance\Entity\Agency');
		$bankRepository = $entityManager->getRepository('Finance\Entity\Bank');
		$agency = $agencyRepository->find($id);

		$form = new AgencyForm($entityManager);

		if($this->request->isPost()){
			$agency->setName($this->request->getPost('name'));
			$agency->setNumber($this->request->getPost('number'));
			$bank = $bankRepository->find($this->request->getPost('bank'));

			$agency->setBank($bank);

			$entityManager->persist($agency);
			$entityManager->flush();
   			
   			$this->flashMessenger()->addSuccessMessage("Agência alterada com sucesso!");

			return $this->redirect()->toRoute('finance', array('controller' => 'Agency', 'action' => 'index'));

		}

		$view_params = array(
			'form' => $form,
			'agency' => $agency,
		);

		return new ViewModel($view_params);
	}	

	# Method for delete agency
	public function deleteAction(){
		
		$id = $this->params()->fromRoute('id');
		if(is_null($id)){
			$id = $this->params()->fromPost('id');
		}

			
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$agencyRepository = $entityManager->getRepository('Finance\Entity\Agency');
		$agency = $agencyRepository->find($id);

			if($this->request->isPost()){

				$entityManager->remove($agency);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage("Agência excluída com sucesso!");

				return $this->redirect()->toRoute('finance', array('controller' => 'Agency', 'action' => 'index'));

			}


		$view_params = ['agency'=>$agency];
		return new ViewModel($view_params);
	}

}