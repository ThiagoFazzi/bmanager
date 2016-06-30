<?php
namespace Finance\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Finance\Entity\Bank;


class AgencyForm extends Form {


	public function __construct($banks) {

		parent::__construct('form-agency');

		#field select for agency
		$this->add([
			'type' => 'Select',
			'name' => 'bank',
			'options' => [
				'empty_option' => 'selecione um banco',
				'value_options' => $banks,
			],
			'attributes' => [
				'class' => 'form-control',
				'id' => 'bank'
			],
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