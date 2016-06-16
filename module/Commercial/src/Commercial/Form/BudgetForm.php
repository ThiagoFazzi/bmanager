<?php
namespace Commercial\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class BudgetForm extends Form {

	public function __construct(){
		parent::__construct('formProduto');
		
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
			'options' => array(
				'label' => 'Endereço de email',
			),
			'attributes' => array(
				'class' => 'form-control',
			)
		));



		//campo descricao
		$this->add ([
			'type' => 'Textarea',
			'name' => 'location',
			'attributes' => [
				'class' => 'form-control'

			]
		]);


		// campo do nome
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
				'class' => 'form-control'

			]
		]);

		$this->add(new Element\Csrf('csrf'));

	}
}