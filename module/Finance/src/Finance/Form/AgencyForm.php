<?php
namespace Finance\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;


class AgencyForm extends Form {


	public function __construct(EntityManager $entityManager) {

		parent::__construct('formAgency');

		#field select for bank
		$this->add([
			'type' => 'DoctrineModule\Form\Element\ObjectSelect',
			'name' => 'bank',
			'options' => [
				'object_manager' => $entityManager,
				'target_class' => 'Finance\Entity\Bank',
				'property' => 'name',
				'empty_option' => 'selecione um banco'
			],
			'attributes' => [
				'class' => 'form-control'
			]
		]);

		# field name for agency
		$this->add([
			'type' => 'Text',
			'name' => 'name',
			'attributes' => [
				'class' => 'form-control',
				'placeholder' => 'nome da agência'
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

		$this->add(new Element\Csrf('csrf'));





	}


}