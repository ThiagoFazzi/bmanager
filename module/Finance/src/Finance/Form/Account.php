<?php
namespace Finance\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;


class AccountForm extends Form {


	public function __construct(EntityManager $entityManager) {

		parent::__construct('formAccount');

		#field select for company
		$this->add([
			'type' => 'DoctrineModule\Form\Element\ObjectSelect',
			'name' => 'company',
			'options' => [
				'object_manager' => $entityManager,
				'target_class' => 'Bmanager\Entity\Company',
				'property' => 'nickName',
				'empty_option' => 'selecione uma empresa'
			],
			'attributes' => [
				'class' => 'form-control'
			]
		]);



		#field select for agency
		$this->add([
			'type' => 'DoctrineModule\Form\Element\ObjectSelect',
			'name' => 'agency',
			'options' => [
				'object_manager' => $entityManager,
				'target_class' => 'Finance\Entity\Agency',
				'property' => 'name',
				'empty_option' => 'selecione uma agência'
			],
			'attributes' => [
				'class' => 'form-control'
			]
		]);

		# field number for agency
		$this->add([
			'type' => 'Text',
			'name' => 'number',
			'attributes' => [
				'class' => 'form-control',
				'placeholder' => 'número da agência'
			]
		]);

		$this->add([
			'type' => 'DoctrineModule\Form\Element\ObjectSelect',
			'name' => 'accountType',
			'options' => [
				'object_manager' => $entityManager,
				'target_class' => 'Finance\Entity\AccountType',
				'property' => 'name',
				'empty_option' => 'selecione um tipo de conta'
			],
			'attributes' => [
				'class' => 'form-control'
			]
		]);		

		$this->add(new Element\Csrf('csrf'));





	}


}