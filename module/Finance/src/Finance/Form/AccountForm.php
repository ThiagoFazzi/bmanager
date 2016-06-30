<?php
namespace Finance\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class AccountForm extends Form {


	public function __construct($companys,$banks,$agencys,$accountTypes) {
		parent::__construct('form-account');

		#field select for company
		$this->add([
			'type' => 'Select',
			'name' => 'company',
			'options' => [
				'empty_option' => 'selecione uma empresa',
				'value_options' => $companys,
			],
			'attributes' => [
				'class' => 'form-control',
			],
		]);

		
		#field select for bank
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
	

		$this->add([
			'type' => 'Select',
			'name' => 'agency',
			'options' => [
				'empty_option' => 'selecione uma agência',
				'value_options' => $agencys,
			],
			'attributes' => [
				'class' => 'form-control',
				'id' => 'agency'
			],
		]);

		# field number for number account
		$this->add([
			'type' => 'Text',
			'name' => 'number',
			'attributes' => [
				'class' => 'form-control',
				'placeholder' => 'número da conta'
			]
		]);

		$this->add([
			'type' => 'Select',
			'name' => 'accountType',
			'options' => [
				'empty_option' => 'selecione um tipo de conta',
				'value_options' => $accountTypes,
			],
			'attributes' => [
				'class' => 'form-control',
			],
		]);		

		$this->add(new Element\Csrf('csrf'));

	} 


}