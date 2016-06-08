<?php

namespace Bmanager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
#use Estoque\Entity\Produto;
#use Zend\Mail\Message;
#use Zend\Mail\Transport\Smtp as SmtpTransport;
#use Zend\Mail\Transport\SmtpOptions;
#use Zend\Mime\Message as MimeMessage;
#use Zend\Mime\Part as MimePart;
#use Estoque\Form\ProdutoForm;
#use Estoque\Entity\Categoria;

class IndexController extends AbstractActionController {

	public function indexAction() {

		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}
	
		return new ViewModel();

	}

}
