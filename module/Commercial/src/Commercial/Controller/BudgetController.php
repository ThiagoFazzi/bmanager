<?php
namespace Commercial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Commercial\Entity\Budget;
use Commercial\Form\BudgetForm;

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


	public function registerAction() {
	
		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		if($this->request->isPost()){

			$client = $this->request->getPost('client');
			$contact = $this->request->getPost('contact');
			$phone = $this->request->getPost('phone');
			$email = $this->request->getPost('email');
			$location = $this->request->getPost('location');
			$cep = $this->request->getPost('cep');
			$service = $this->request->getPost('service');
			$description = $this->request->getPost('description');

			$budget = new Budget($contact, $email, $location, $service, $description);

			$budget->setClient($client);
			$budget->setPhone($phone);
			$budget->setCep($cep);
			#$budget->setGeoLocation();


			$form->setInputFilter($budget->getInputFilter());
			$form->setData($this->request->getPost());

			if($form->isValid()){
				
				$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

				$entityManager->persist($budget);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage('Orçamento cadastrado com sucesso!!');


				return $this->redirect()->toRoute('commercial', array('controller' => 'Budget', 'action' => 'index'));
			}


		}

		$form = new BudgetForm();
		return new ViewModel(['form' => $form]);

	}	




	public function deleteAction(){
		
		$id = $this->params()->fromRoute('id');
		if(is_null($id)){
			$id = $this->params()->fromPost('id');
		}

			
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$budgetRepository = $entityManager->getRepository('Commercial\Entity\Budget');
		$budget = $budgetRepository->find($id);

			if($this->request->isPost()){

				$entityManager->remove($budget);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage("Excluído com sucesso!");


				return $this->redirect()->toRoute('commercial', array('controller' => 'Budget', 'action' => 'index'));


			}

		

		$view_params = ['budget'=>$budget];
		return new ViewModel($view_params);
	}





	public function updateAction(){


		$id = $this->params()->fromRoute('id');

		if(is_null($id)){
			$id = $this->request->getPost('id');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$budgetRepository = $entityManager->getRepository('Commercial\Entity\Budget');

		$budget = $budgetRepository->find($id);

		if($this->request->isPost()){
			$budget->setClient($this->request->getPost('client'));
			$budget->setContact($this->request->getPost('contact'));
			$budget->setPhone($this->request->getPost('phone'));
			$budget->setEmail($this->request->getPost('email'));
			$budget->setLocation($this->request->getPost('location'));
			$budget->setCep($this->request->getPost('cep'));
			$budget->setService($this->request->getPost('service'));
			$budget->setDescription($this->request->getPost('description'));

			$entityManager->persist($budget);
			$entityManager->flush();
   			
   			$this->flashMessenger()->addSuccessMessage("Alterado com sucesso!");

			return $this->redirect()->toRoute('commercial', array('controller' => 'Budget', 'action' => 'index'));

		}

		$form = new BudgetForm();

		$view_params = array(
			'form' => $form,
			'budget' => $budget,
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