<?php
namespace Finance\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;
use Finance\Entity\Account;
use Finance\Form\AccountForm;
use Finance\Validator\AccountValidator;
use Zend\View\Model\JsonModel;
use Bmanager\Entity\Company;
use Finance\Entity\Agency;
use Finance\Entity\AccountType;
use Zend\Json\Json;
use Doctrine\ORM\Query;

class AccountController extends AbstractActionController {

	protected $serviceLocator = null;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }


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
		$companys = $companyRepository->getFindCompany();
		$bankRepository = $entityManager->getRepository('Finance\Entity\Bank');
		$banks = $bankRepository->getFindBank();
		$agencyRepository = $entityManager->getRepository('Finance\Entity\Agency');
		$agencys = $agencyRepository->getFindAgency();
		$accountTypeRepository = $entityManager->getRepository('Finance\Entity\AccountType');
		$accountTypes = $accountTypeRepository->getFindAccountType();
		$form = new AccountForm($companys,$banks,$agencys,$accountTypes);

		if($this->request->isPost()){
		
			$company = $companyRepository->find($this->request->getPost('company'));
			$bank = $bankRepository->find($this->request->getPost('bank'));
			$agency = $agencyRepository->find($this->request->getPost('agency'));
			$number = $this->request->getPost('number');
			$accountType = $accountTypeRepository->find($this->request->getPost('accountType'));

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

	# Method for update agency
	public function updateAction(){

		$id = $this->params()->fromRoute('id');
		if(is_null($id)){
			$id = $this->request->getPost('id');
		}	

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$companyRepository = $entityManager->getRepository('Bmanager\Entity\Company');
		$companys = $companyRepository->getFindCompany();
		$bankRepository = $entityManager->getRepository('Finance\Entity\Bank');
		$banks = $bankRepository->getFindBank();
		$agencyRepository = $entityManager->getRepository('Finance\Entity\Agency');
		$agencys = $agencyRepository->getFindAgency();
		$accountTypeRepository = $entityManager->getRepository('Finance\Entity\AccountType');
		$accountTypes = $accountTypeRepository->getFindAccountType();
		$accountRepository = $entityManager->getRepository('Finance\Entity\Account');
		$account = $accountRepository->find($id);
		$form = new AccountForm($companys,$banks,$agencys,$accountTypes);

		if($this->request->isPost()){
		
			$company = $companyRepository->find($this->request->getPost('company'));
			$bank = $bankRepository->find($this->request->getPost('bank'));
			$agency = $agencyRepository->find($this->request->getPost('agency'));
			$accountType = $accountTypeRepository->find($this->request->getPost('accountType'));

			$account->setNumber($this->request->getPost('number'));
			$account->setCompany($company);
			$account->setAgency($agency);
			$account->setAccountType($accountType);

			$accountValidator = new AccountValidator();
			$form->setInputFilter($accountValidator->getInputFilter());
			$form->setData($this->request->getPost());

			if($form->isValid()){
				
				$entityManager->persist($account);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage('Conta alterada com sucesso!!');
				return $this->redirect()->toRoute('finance', array('controller' => 'Account', 'action' => 'index'));
			}
		}

		$view_params = array(
			'form' => $form,
			'account' => $account,
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
		$accountRepository = $entityManager->getRepository('Finance\Entity\Account');
		$account = $accountRepository->find($id);

			if($this->request->isPost()){

				$entityManager->remove($account);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage("Conta excluída com sucesso!");

				return $this->redirect()->toRoute('finance', array('controller' => 'Account', 'action' => 'index'));

			}


		$view_params = ['account'=>$account];
		return new ViewModel($view_params);
	}

}