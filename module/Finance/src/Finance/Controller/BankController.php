<?php
namespace Finance\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Finance\Entity\Bank;
use Finance\Form\BankForm;
use Finance\Validator\BankValidator;

class BankController extends AbstractActionController {

	# Method for list all banks
	public function indexAction() {

		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$bankRepository = $entityManager->getRepository('Finance\Entity\Bank');
		$banks = $bankRepository->findALL();

		$view_params = array(
			'banks' => $banks,
		);
		return new ViewModel($view_params);

	}

	# Method for insert bank
	public function registerAction() {
	
		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}
		
		$form = new BankForm();

		if($this->request->isPost()){
			
			$name = $this->request->getPost('name');
			$number = $this->request->getPost('number');

			$bank = new Bank($name,$number);

			$bankValidator = new BankValidator();

			$form->setInputFilter($bankValidator->getInputFilter());
			$form->setData($this->request->getPost());

			if($form->isValid()){
				
				$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
				$entityManager->persist($bank);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage('Banco cadastrado com sucesso!!');

				return $this->redirect()->toRoute('finance', array('controller' => 'Bank', 'action' => 'index'));
			}
		}

		return new ViewModel(['form' => $form]);
	}	

	# Method for update bank
	public function updateAction(){

		$id = $this->params()->fromRoute('id');
		
		if(is_null($id)){
			$id = $this->request->getPost('id');
		}

		$form = new BankForm();

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$bankRepository = $entityManager->getRepository('Finance\Entity\Bank');
		$bank = $bankRepository->find($id);

		if($this->request->isPost()){
			$bank->setName($this->request->getPost('name'));
			$bank->setNumber($this->request->getPost('number'));

			$entityManager->persist($bank);
			$entityManager->flush();
   			
   			$this->flashMessenger()->addSuccessMessage("Banco alterado com sucesso!");

			return $this->redirect()->toRoute('finance', array('controller' => 'Bank', 'action' => 'index'));

		}

		$view_params = array(
			'form' => $form,
			'bank' => $bank,
		);

		return new ViewModel($view_params);
	}	

	# Method for delete company
	public function deleteAction(){
		
		$id = $this->params()->fromRoute('id');
		if(is_null($id)){
			$id = $this->params()->fromPost('id');
		}

			
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$bankRepository = $entityManager->getRepository('Finance\Entity\Bank');
		$bank = $bankRepository->find($id);

			if($this->request->isPost()){

				$entityManager->remove($bank);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage("Banco excluído com sucesso!");

				return $this->redirect()->toRoute('finance', array('controller' => 'Bank', 'action' => 'index'));

			}


		$view_params = ['bank'=>$bank];
		return new ViewModel($view_params);
	}

}