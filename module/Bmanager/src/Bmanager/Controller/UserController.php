<?php
namespace Bmanager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;


class UserController extends AbstractActionController {

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


	public function indexAction() {

		return new ViewModel();
	}

	public function loginAction() {

		if($this->request->isPost()) {

			$dados = $this->request->getPost();

			$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
			$authAdapter = $authService->getAdapter();

			$authAdapter->setIdentityValue($dados['userName']);
			$authAdapter->setCredentialValue($dados['password']);

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