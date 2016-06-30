<?php
namespace Finance\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;


class AccountTypeForm extends Form {


	public function __construct() {

		parent::__construct('formAccountType');

		# field name for AccountType
		$this->add([
			'type' => 'Text',
			'name' => 'name',
			'attributes' => [
				'class' => 'form-control',
				'placeholder' => 'Tipo da Conta'
			]
		]);


		$this->add(new Element\Csrf('csrf'));





	}


}