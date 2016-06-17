<?php
namespace Purchase\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class ProviderForm extends Form {

	public function __construct(){
		parent::__construct('formProvider');
		
		// field nickName
		$this->add(array(
			'type' =>'Text',
			'name' =>'nickName',
			'attributes' => array(
				'class' => 'form-control',
				'placeholder' => 'nome da empresa'
			)
		));

		// field companyName
		$this->add(array(
			'type' =>'Text',
			'name' =>'companyName',
			'attributes' => array(
				'class' => 'form-control',
			)
		));

		// field Cnpj
		$this->add(array(
			'type' =>'Text',
			'name' =>'cnpj',
			'attributes' => array(
				'class' => 'form-control',
				'placeholder' => '99.999.999/9999-99'
			)
		));

		#field ie
		$this->add(array(
			'type' =>'Text',
			'name' =>'ie',
			'attributes' => array(
				'class' => 'form-control',
				'placeholder' => '999.999.999'
			)
		));

		#field im
		$this->add(array(
			'type' =>'Text',
			'name' =>'im',
			'attributes' => array(
				'class' => 'form-control',
				'placeholder' => '999.999.999'
			)
		));

		#field street
		$this->add(array(
			'type' =>'Text',
			'name' =>'street',
			'attributes' => array(
				'class' => 'form-control',
			)
		));		

		#field number
		$this->add(array(
			'type' =>'Text',
			'name' =>'number',
			'attributes' => array(
				'class' => 'form-control',
			)
		));

		#field neighborhood
		$this->add(array(
			'type' =>'Text',
			'name' =>'neighborhood',
			'attributes' => array(
				'class' => 'form-control',
			)
		));

		#field city
		$this->add(array(
			'type' =>'Text',
			'name' =>'city',
			'attributes' => array(
				'class' => 'form-control',
			)
		));

		#field state
		$this->add(array(
			'type' =>'Text',
			'name' =>'state',
			'attributes' => array(
				'class' => 'form-control',
			)
		));

		#field cep
		$this->add(array(
			'type' =>'Text',
			'name' =>'cep',
			'attributes' => array(
				'class' => 'form-control',
				'placeholder' => '99999-999'
			)
		));

		#field phone
		$this->add([
			'type' =>'Text',
			'name' =>'phone',
			'attributes' => [
				'class' =>'form-control',
				'placeholder' => '99 99999-9999'
				
			]
		]);

		#field email
		$this->add([
			'type' =>'Text',
			'name' =>'email',
			'attributes' => [
				'class' =>'form-control'
				
			]
		]);

		$this->add(new Element\Csrf('csrf'));

	}
}