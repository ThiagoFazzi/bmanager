<?php
namespace Bmanager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class UserController extends AbstractActionController {

	public function indexAction() {

		return new ViewModel();
	}

	public function loginAction() {

		if($this->request->isPost()) {

			$dados = $this->request->getPost();

			$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
			$authAdapter = $authService->getAdapter();

			#$class_methods = get_class_methods($authAdapter);
			#echo "<pre>";
			#print_r($class_methods);
			#exit();


			$authAdapter->setIdentityValue($dados['userName']);
			$authAdapter->setCredentialValue($dados['password']);

			#echo "<pre>";
			#print_r($authAdapter->getIdentity());
			#print_r($authAdapter->getCredential());
			#exit();



			$authResult = $authService->authenticate();

			if($authResult->isValid()) {
				return $this->redirect()->toUrl('/Index/index');
			}

			$this->flashMessenger()->addErrorMessage('Usuário ou senha inválidos.');
			return $this->redirect()->toUrl('/User/index');

		}else {
			
			return $this->redirect()->toUrl('/User/index');
		}

	}

	public function logoutAction() {

		$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		$authService->clearIdentity();

		return $this->redirect()->toUrl('/User/index');

	}
}