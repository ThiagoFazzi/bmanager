<?php
namespace Finance\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class StructureItemForm extends Form {

	public function __construct(){
		parent::__construct('form-structure-item');
		
		// field name of item
		$this->add(array(
			'type' =>'Text',
			'name' =>'name',
			'attributes' => array(
				'class' => 'form-control',
				'placeholder' => 'nome do item'
			)
		));

		$this->add(new Element\Csrf('csrf'));

	}
}