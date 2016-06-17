<?php
namespace Commercial\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class BudgetForm extends Form {

	public function __construct(){
		parent::__construct('formBudget');
		
		// campo do nome
		$this->add([
			'type' =>'Text',
			'name' =>'client',
			'attributes' => [
				'class' =>'form-control'
				
			]
		]);

		// campo do nome
		$this->add([
			'type' =>'Text',
			'name' =>'contact',
			'attributes' => [
				'class' =>'form-control'
				
			]
		]);

		// campo do nome
		$this->add([
			'type' =>'Text',
			'name' =>'phone',
			'attributes' => [
				'class' =>'form-control'
				
			]
		]);

		#campo email
		$this->add(array(
			'type' =>'Email',
			'name' =>'email',
			'attributes' => array(
				'class' => 'form-control',
			)
		));



		//campo descricao
		$this->add ([
			'type' => 'Textarea',
			'name' => 'location',
			'attributes' => [
				'class' => 'form-control',
				'rows' => '3'

			]
		]);


		# field cep
		$this->add([
			'type' =>'Text',
			'name' =>'cep',
			'attributes' => [
				'class' =>'form-control'
				
			]
		]);

		#Campo Serviço
		$this->add([
			'type' =>'Text',
			'name' =>'service',
			'attributes' => [
				'class' =>'form-control'
				
			]
		]);

		#Campo Descrição
		$this->add ([
			'type' => 'Textarea',
			'name' => 'description',
			'attributes' => [
				'class' => 'form-control',
				'rows' => '5'

			]
		]);

		$this->add(new Element\Csrf('csrf'));

	}
}