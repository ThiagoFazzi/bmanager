<?php
namespace Purchase\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Purchase\Entity\Provider;
use Purchase\Form\ProviderForm;
use Purchase\Validator\ProviderValidator;

class ProviderController extends AbstractActionController {

	# Method for list all companys
	public function indexAction() {

		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$providerRepository = $entityManager->getRepository('Purchase\Entity\Provider');
		$providers = $providerRepository->findALL();

		$view_params = array(
			'providers' => $providers,
		);
		return new ViewModel($view_params);

	}

	# Method for insert company
	public function registerAction() {
	
		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}
		
		$form = new ProviderForm();

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

			$provider = new Provider($nickName,$companyName,$cnpj,$im,$street,$number,$neighborhood,$city,$state,$cep,$phone,$email);
			$provider->setIe($ie);

			$providerValidator = new ProviderValidator();

			$form->setInputFilter($providerValidator->getInputFilter());
			$form->setData($this->request->getPost());

			if($form->isValid()){
				
				$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
				$entityManager->persist($provider);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage('Fornecedor cadastrado com sucesso!!');

				return $this->redirect()->toRoute('purchase', array('controller' => 'Provider', 'action' => 'index'));
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

		$form = new ProviderForm();

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$providerRepository = $entityManager->getRepository('Purchase\Entity\Provider');

		$provider = $providerRepository->find($id);

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

			$entityManager->persist($provider);
			$entityManager->flush();
   			
   			$this->flashMessenger()->addSuccessMessage("Fornecedor alterado com sucesso!");

			return $this->redirect()->toRoute('purchase', array('controller' => 'Provider', 'action' => 'index'));

		}

		$view_params = array(
			'form' => $form,
			'provider' => $provider,
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
		$providerRepository = $entityManager->getRepository('Purchase\Entity\Provider');
		$provider = $providerRepository->find($id);

			if($this->request->isPost()){

				$entityManager->remove($provider);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage("Fornecedor excluído com sucesso!");

				return $this->redirect()->toRoute('purchase', array('controller' => 'Provider', 'action' => 'index'));

			}


		$view_params = ['provider'=>$provider];
		return new ViewModel($view_params);
	}

}