<?php
namespace Finance\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Finance\Entity\AccountType;
use Finance\Form\AccountTypeForm;
use Finance\Validator\AccountTypeValidator;

class AccountTypeController extends AbstractActionController {

	# Method for list all AccountType
	public function indexAction() {

		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$accountsRepository = $entityManager->getRepository('Finance\Entity\AccountType');
		$accounts = $accountsRepository->findALL();

		$view_params = array(
			'accounts' => $accounts,
		);
		return new ViewModel($view_params);

	}

	# Method for insert AccountType
	public function registerAction() {
	
		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		
		$form = new AccountTypeForm();

		if($this->request->isPost()){
			
			$name = $this->request->getPost('name');

			$accountType = new AccountType($name);

			$accountTypeValidator = new AccountTypeValidator();

			$form->setInputFilter($accountTypeValidator->getInputFilter());
			$form->setData($this->request->getPost());

			if($form->isValid()){
				
				$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
				$entityManager->persist($accountType);
				$entityManager->flush();			

	

				$this->flashMessenger()->addSuccessMessage('Tipo de conta cadastrada com sucesso!!');

				return $this->redirect()->toRoute('finance', array('controller' => 'AccountType', 'action' => 'index'));
			}
		}

		return new ViewModel(['form' => $form]);
	}	

	# Method for update AccountType
	public function updateAction(){

		$id = $this->params()->fromRoute('id');
		
		if(is_null($id)){
			$id = $this->request->getPost('id');
		}	

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$accountTypeRepository = $entityManager->getRepository('Finance\Entity\AccountType');
		$accountType = $accountTypeRepository->find($id);

		$form = new AccountTypeForm($entityManager);

		if($this->request->isPost()){
			$accountType->setName($this->request->getPost('name'));


			$entityManager->persist($accountType);
			$entityManager->flush();
   			
   			$this->flashMessenger()->addSuccessMessage("Tipo de conta alterada com sucesso!");

			return $this->redirect()->toRoute('finance', array('controller' => 'AccountType', 'action' => 'index'));

		}

		$view_params = array(
			'form' => $form,
			'accountType' => $accountType,
		);

		return new ViewModel($view_params);
	}	

	# Method for delete AccountType
	public function deleteAction(){
		
		$id = $this->params()->fromRoute('id');
		if(is_null($id)){
			$id = $this->params()->fromPost('id');
		}

			
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$accountTypeRepository = $entityManager->getRepository('Finance\Entity\AccountType');
		$accountType = $accountTypeRepository->find($id);

			if($this->request->isPost()){

				$entityManager->remove($accountType);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage("Tipo de Conta excluída com sucesso!");

				return $this->redirect()->toRoute('finance', array('controller' => 'AccountType', 'action' => 'index'));

			}


		$view_params = ['accountType'=>$accountType];
		return new ViewModel($view_params);
	}

}