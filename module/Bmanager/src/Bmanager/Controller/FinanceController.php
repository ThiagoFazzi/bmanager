<?php

namespace Bmanager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FinanceController extends AbstractActionController {

	public function indexAction() {

		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		return new ViewModel();
	}

	public function paymentAction() {

		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}
	
		#return $this->redirect()->toUrl('/finance/payment');
		return new ViewModel();

	}	

}