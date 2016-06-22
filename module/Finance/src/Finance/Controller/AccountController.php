<?php
namespace Finance\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Finance\Entity\Account;
use Finance\Form\AccountForm;
use Finance\Validator\AccountValidator;
use Zend\View\Model\JsonModel;
use Bmanager\Entity\Company;
use Finance\Entity\Agency;
use Finance\Entity\AccountType;
use Zend\Json\Json;

class AccountController extends AbstractActionController {

	# Method for list all accounts
	public function indexAction() {

		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$accountRepository = $entityManager->getRepository('Finance\Entity\Account');
		$accounts = $accountRepository->findALL();

		$view_params = array(
			'accounts' => $accounts,
		);
		return new ViewModel($view_params);

	}

	# Method for insert a new account
	public function registerAction() {
	
		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$companyRepository = $entityManager->getRepository('Bmanager\Entity\Company');
		$bankRepository = $entityManager->getRepository('Finance\Entity\Bank');
		$agencyRepository = $entityManager->getRepository('Finance\Entity\Agency');
		$accountTypeRepository = $entityManager->getRepository('Finance\Entity\AccountType');
		
		$form = new AccountForm($entityManager);

		if($this->request->isPost()){
			
			$number = $this->request->getPost('number');
		
			$company = $companyRepository->find($this->request->getPost('company'));
			$bank = $bankRepository->find($this->request->getPost('bank'));
			$agency = $agencyRepository->find($this->request->getPost('agency'));
			$accountType = $accountTypeRepository->find($this->request->getPost('accountType'));

			//echo "<pre>";
			//var_dump($agency->getBank()->getName());
			//echo "</pre>";

			$agency->setBank($bank);

			//echo "<pre>";
			//echo print_r($agency);
			//echo "</pre>";


			$account = new Account($number);
			$account->setCompany($company);
			$account->setAgency($agency);
			$account->setAccountType($accountType);

			$accountValidator = new AccountValidator();

			$form->setInputFilter($accountValidator->getInputFilter());
			$form->setData($this->request->getPost());

			if($form->isValid()){
				
				$entityManager->persist($account);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage('Conta cadastrada com sucesso!!');

				return $this->redirect()->toRoute('finance', array('controller' => 'Account', 'action' => 'index'));
			}
		}

		return new ViewModel(['form' => $form]);
	}

	public function findAgencyByBankAction() {

		$id = $this->params()->fromRoute('id');
		if(is_null($id)){
			$id = $this->params()->fromPost('id');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$agencyRepository = $entityManager->getRepository('Finance\Entity\Agency');
		$agencys = $agencyRepository->findBy(array('bank' => $id));

  		foreach($agencys as $key => $value) {   
    		$array[] = array(
        		'id' => $value->getId(),
        		'name' => $value->getName(),
    		);
 		 }

		return new JsonModel($array);

	}

	# Method for update agency
	/*public function updateAction(){

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
	}*/

}