<?php

namespace Finance\Validator;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\Validator;

class BankValidator implements InputFilterAwareInterface {

	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new Exception('Você não deve invocar este método');
		
	}

	public function getInputFilter() {

		$inputFilter = new InputFilter();
/*
		$inputFilter->add(
			[
				'name' => 'nickName',
				'required' => true,
				'validators' => [
					[
						'name' => 'notEmpty'
					],					
					[
						'name' => 'stringLength',
						'options' => [
							'min' => 3,
							'max' => 30
						]
					]
				]
			],
			[
				'name' => 'companyName',
				'required' => true,
				'validators' => [
					[
						'name' => 'notEmpty'
					],				
					[
						'name' => 'stringLength',
						'options' => [
							'min' => 3,
							'max' => 50
						]
					]
				]
			]
		);/*
			array(
				'name' => 'cnpj',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'stringLength',
						'options' => array(
							'min' => 3,
							'max' => 14,
						)
					),
					array(
						'name' => 'notEmpty',
					)
				)
			),
			array(
				'name' => 'ie',
				'required' => false,
				'validators' => array(
					array(
						'name' => 'stringLength',
						'options' => array(
							'min' => 3,
							'max' => 30,
						)
					)
				)
			),
			array(
				'name' => 'im',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'stringLength',
						'options' => array(
							'min' => 3,
							'max' => 30,
						)
					),
					array(
						'name' => 'notEmpty',
					)
				)
			),
			array(
				'name' => 'street',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'stringLength',
						'options' => array(
							'min' => 3,
							'max' => 30,
						)
					),
					array(
						'name' => 'notEmpty',
					)
				)
			),
			array(
				'name' => 'number',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'stringLength',
						'options' => array(
							'min' => 1,
							'max' => 10,
						)
					),
					array(
						'name' => 'notEmpty',
					)
				)
			),
			array(
				'name' => 'neighborhood',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'stringLength',
						'options' => array(
							'min' => 3,
							'max' => 30,
						)
					),
					array(
						'name' => 'notEmpty',
					)
				)
			),
			array(
				'name' => 'city',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'stringLength',
						'options' => array(
							'min' => 3,
							'max' => 30,
						)
					),
					array(
						'name' => 'notEmpty',
					)
				)
			),
			array(
				'name' => 'state',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'stringLength',
						'options' => array(
							'min' => 3,
							'max' => 30,
						)
					),
					array(
						'name' => 'notEmpty',
					)
				)
			),
			array(
				'name' => 'cep',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'stringLength',
						'options' => array(
							'min' => 8,
							'max' => 8,
						)
					),
					array(
						'name' => 'notEmpty',
					)
				)
			),
			array(
				'name' => 'phone',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'stringLength',
						'options' => array(
							'min' => 10,
							'max' => 11,
						)
					),
					array(
						'name' => 'notEmpty',
					)
				)
			),
			array(
				'name' => 'email',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'stringLength',
						'options' => array(
							'min' => 3,
							'max' => 30,
						)
					),
					array(
						'name' => 'notEmpty',
					)
				)
			)
		*/

		return $inputFilter;

	
	}

}