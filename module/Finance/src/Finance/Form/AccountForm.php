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

		$this->add([
			'type' => 'DoctrineModule\Form\Element\ObjectSelect',
			'name' => 'bank',
			'options' => [
				'object_manager' => $entityManager,
				'target_class' => 'Finance\Entity\Bank',
				'property' => 'name',
				'empty_option' => 'selecione um banco',
			],
			'attributes' => [
				'class' => 'form-control',
			]
		]);

		$this->add([
			'type' => 'DoctrineModule\Form\Element\ObjectSelect',
			'name' => 'agency',
			'options' => [
				'object_manager' => $entityManager,
				'target_class' => 'Finance\Entity\Agency',
				'property' => 'name',
				'empty_option' => 'selecione uma agência',
			],
			'attributes' => [
				'class' => 'form-control',
				'id' => 'bank',
			]
		]);

		#field select for bank
		/*$this->add([
			'type' => 'DoctrineModule\Form\Element\ObjectSelect',
			'name' => 'bank',
			'options' => [
				'object_manager' => $entityManager,
				'target_class' => 'Finance\Entity\Bank',
				'property' => 'name',
				'empty_option' => 'selecione um banco',
			],
			'attributes' => [
				'class' => 'form-control',
				'id' => 'bank',
				'onChange' => 'getAgencyByBank()'
				
			]
		]);*/

		/*#field select for agency
		$this->add([
			'type' => 'Select',
			'name' => 'agency',
			'options' => [
				'empty_option' => 'selecione uma agência',
			],
			'attributes' => [
				'class' => 'form-control',
				'id' => 'agency'
			],
		]);*/

		# field number for number account
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