<?php
namespace Finance\Form;

use Zend\Form\Form;
use Zend\Form\Element;


class StructureForm extends Form {


	public function __construct() {

		parent::__construct('form-structure');

		#field select for agency
		$this->add([
			'type' => 'Select',
			'name' => 'company',
			'options' => [
				'empty_option' => 'selecione uma Empresa',
			],
			'attributes' => [
				'class' => 'form-control',
			],
		]);

		#field select for agency
		$this->add([
			'type' => 'Select',
			'name' => 'item',
			'options' => [
				'empty_option' => 'selecione um item de estrutura',
			],
			'attributes' => [
				'class' => 'form-control',
			],
		]);

		# field name for agency
		$this->add([
			'type' => 'Text',
			'name' => 'inherit',
			'attributes' => [
				'class' => 'form-control',
				'placeholder' => 'Item Pai',
				'id' => 'inherit'
			]
		]);

		$this->add([
			'type' => 'Hidden',
			'name' => 'inheritId',
			'attributes' => [
				'id' => 'inheritId'
			]
		]);

		$this->add(new Element\Csrf('csrf'));

	}
}