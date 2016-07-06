<?php
namespace Bmanager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;
use Bmanager\Entity\Company;
use Bmanager\Form\CompanyForm;
use Bmanager\Validator\CompanyValidator;
use Bmanager\Entity\LevelRepository;

class CompanyController extends AbstractActionController {

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

	# Method for list all companys
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

	# Method for insert company
	public function registerAction() {
	
		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}
		
		$form = new CompanyForm();

		if($this->request->isPost()){
			
			$nickName = $this->request->getPost('nickName');
			$companyName = $this->request->getPost('companyName');
			$cnpj = $this->request->getPost('cnpj');
			$ie = $this->request->getPost('ie');
			$im = $this->request->getPost('im');
			$street = $this->request->getPost('street');
			$number = $this->request->getPost('number');
			$neighborhood = $this->request->getPost('neighborhood');
			$city = $this->request->getPost('city');
			$state = $this->request->getPost('state');
			$cep = $this->request->getPost('cep');
			$phone = $this->request->getPost('phone');
			$email = $this->request->getPost('email');

			$company = new Company($nickName,$companyName,$cnpj,$im,$street,$number,$neighborhood,$city,$state,$cep,$phone,$email);
			$company->setIe($ie);

			$companyValidator = new CompanyValidator();

			$form->setInputFilter($companyValidator->getInputFilter());
			$form->setData($this->request->getPost());

			if($form->isValid()){
				
				$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
				$entityManager->persist($company);
				$entityManager->flush();




				$levelRepository = $entityManager->getRepository('Bmanager\Entity\Level');
				$levelRepository->createLevelCompany($company,$entityManager);

				$this->flashMessenger()->addSuccessMessage('Empresa cadastrada com sucesso!!');

				return $this->redirect()->toRoute('application', array('controller' => 'Company', 'action' => 'index'));
			}
		}

		return new ViewModel(['form' => $form]);
	}	

	# Method for update company
	public function updateAction(){

		$id = $this->params()->fromRoute('id');
		
		if(is_null($id)){
			$id = $this->request->getPost('id');
		}

		$form = new CompanyForm();

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$companyRepository = $entityManager->getRepository('Bmanager\Entity\Company');

		$company = $companyRepository->find($id);

		if($this->request->isPost()){
			$company->setNickName($this->request->getPost('nickName'));
			$company->setCompanyName($this->request->getPost('companyName'));
			$company->setCnpj($this->request->getPost('cnpj'));
			$company->setIe($this->request->getPost('ie'));
			$company->setIm($this->request->getPost('im'));
			$company->setStreet($this->request->getPost('street'));
			$company->setNumber($this->request->getPost('number'));
			$company->setNeighborhood($this->request->getPost('neighborhood'));
			$company->setCity($this->request->getPost('city'));
			$company->setState($this->request->getPost('state'));
			$company->setCep($this->request->getPost('cep'));
			$company->setEmail($this->request->getPost('email'));
			$company->setPhone($this->request->getPost('phone'));

			$entityManager->persist($company);
			$entityManager->flush();
   			
   			$this->flashMessenger()->addSuccessMessage("Empresa alterada com sucesso!");

			return $this->redirect()->toRoute('application', array('controller' => 'Company', 'action' => 'index'));

		}

		$view_params = array(
			'form' => $form,
			'company' => $company,
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
		$companyRepository = $entityManager->getRepository('Bmanager\Entity\Company');
		$company = $companyRepository->find($id);

			if($this->request->isPost()){

				$entityManager->remove($company);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage("Empresa excluída com sucesso!");

				return $this->redirect()->toRoute('application', array('controller' => 'Company', 'action' => 'index'));

			}


		$view_params = ['company'=>$company];
		return new ViewModel($view_params);
	}

}