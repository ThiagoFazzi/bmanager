<?php

namespace Commercial\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\Form\Email;
use Zend\Form\Form;

/** @ORM\Entity */
Class Budget implements InputFilterAwareInterface {


	/**
	*@ORM\Id
	*@ORM\GeneratedValue(strategy= "AUTO")
	*@ORM\Column(type="integer")	
	*/
	private $id;

	/**
	*@ORM\Column(type="string", length=255,nullable=true)
	*/
	private $client;

	/**
	*@ORM\Column(type="string", length=255)
	*/
	private $contact;

	/**
	*@ORM\Column(type="string", length=255,nullable=true)
	*/
	private $phone;

	/**
	*@ORM\Column(type="string", length=255)
	*/
	private $email;

	/**
	*@ORM\Column(type="string", length=255)
	*/
	private $location;

	/**
	*@ORM\Column(type="string", length=255,nullable=true)
	*/
	private $cep;

	/**
	*@ORM\Column(type="string", length=255)
	*/
	private $service;

	/**
	*@ORM\Column(type="string", length=255)
	*/
	private $description;

	/**
	*@ORM\Column(type="string", length=255)
	*/
	private $status;

	/**
	*@ORM\Column(type="datetime")
	*/
	private $requestDate;

	/**
	*@ORM\Column(type="string",length=255,nullable=true)
	*/
	private $geoLocation;

	public function  __construct($contact, $email, $location, $service, $description) {
		$this->contact = $contact;
		$this->email = $email;
		$this->location = $location;
		$this->service = $service;
		$this->description = $description;
		$this->status = '1'; // 1(novo) 2(em andamento) 3(aprovado) 4(reprovado).
		$this->requestDate = new \DateTime('now');

	}

	public function getId() {
		return $this->id;
	}

	public function getClient() {
		return $this->client;
	}

	public function getContact() {
		return $this->contact;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function getEmail() {
		return $this->email;
	}	

	public function getLocation() {
		return $this->location;
	}

	public function getService() {
		return $this->service;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getCep(){
		return $this->cep;
	}

	public function getGeoLocation(){
		return $this->geoLocation;
	}

	public function getRequestDate(){
		return $this->requestDate;
	}

	public function getStatus(){
		return $this->getStatus;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setClient($client) {
		$this->client = $client;
	}

	public function setContact($contact) {
		$this->contact = $contact;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

	public function setEmail($email) {
		$this->email =$email;
	}

	public function setLocation($location) {
		$this->location = $location;
	}

	public function setService($service) {
		$this->service = $service;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setCep($cep){
		$this->cep = $cep;
	}

	public function setGeoLocation($geoLocation){
		$this->geoLocation = $geoLocation;
	}

	public function setRequestDate($requestDate){
		$this->requestDate = $requestDate;
	}

	public function setStatus($status){
		$this->status = $status;
	}


	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new Exception("Você não deve invocar esse metodo");
	}

	public function getInputFilter() {
		$inputFilter = new InputFilter();

		$inputFilter->add(
			[
				'name' => 'client',
				'requered' => 'true',
				'validators' => [
					[
						'name' => 'StringLength',
						'options' =>[
							'min' => 3,
							'max' => 80,
						]
					]
				]
			],  		

		
			[
				'name' => 'contact',
				'requered' => 'true',
				'validators' => [
					[
						'name' => 'StringLength',
						'options' =>[
							'min' => 3,
							'max' => 100
						]
					]
				]
			],

		 


			[
				'name' => 'phone',
				'requered' => 'false',
				'filters' => [
					[
						'name' => 'Int',
					]
				],
				'validators' => [
					[
						'name' => 'Zend\Validator\Between',
						'options' =>[
							'min' => 10,
							'max' => 12
						]
					]
				]
			],


			[
				'name' => 'location',
				'requered' => 'true',
				'validators' => [
					[
						'name' => 'StringLength',
						'options' =>[
							'min' => 3,
							'max' => 100
						]
					]
				]
			],	


			[
				'name' => 'cep',
				'requered' => 'false',
				'filters' => [
					[
						'name' => 'Int',
					]
				],
				'validators' => [
					[
						'name' => 'Zend\Validator\Between',
						'options' =>[
							'min' => 8,
							'max' => 9
						]
					]
				]
			],	

			[
				'name' => 'service',
				'requered' => 'true',
				'validators' => [
					[
						'name' => 'StringLength',
						'options' =>[
							'min' => 3,
							'max' => 150
						]
					]
				]
			], 

			[
				'name' => 'description',
				'requered' => 'true',
				'validators' => [
					[
						'name' => 'StringLength',
						'options' =>[
							'min' => 3,
							'max' => 200
						]
					]
				]
			]

		); 



		return $inputFilter;
	}

}
