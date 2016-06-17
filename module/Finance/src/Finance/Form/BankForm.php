<?php
namespace Finance\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class BankForm extends Form {

	public function __construct(){
		parent::__construct('formBank');
		
		// field name of bank
		$this->add(array(
			'type' =>'Text',
			'name' =>'name',
			'attributes' => array(
				'class' => 'form-control',
				'placeholder' => 'nome do banco'
			)
		));

		// field number for bank
		$this->add(array(
			'type' =>'Text',
			'name' =>'number',
			'attributes' => array(
				'class' => 'form-control',
				'placeholder' => 'número do banco'
			)
		));

		$this->add(new Element\Csrf('csrf'));

	}
}