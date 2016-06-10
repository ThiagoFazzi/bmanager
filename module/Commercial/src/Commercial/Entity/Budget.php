<?php

namespace Commercial\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilter;

/** @ORM\Entity(repositoryClass="\Budget\Entity\Repository\BudgetRepository") */
Class Budget implements InputFilterAwareInterface{


	/**
	*@ORM\Id
	*@ORM\GeneratedValue(strategy= "AUTO")
	*@ORM\COlumn(type="integer")	
	*/
	private $id;

	/**
	*@ORM\Column(type="string", length=255)
	*/
	private $client;

	/**
	*@ORM\Column(type="string", length=255)
	*/
	private $contact;

	/**
	*@ORM\Column(type="string", length=255)
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
	*@ORM\Column(type="string", length=255)
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
	*@ORM\Column(type="string", length=255)
	*/
	private $requestDate;

	/**
	*@ORM\Column(type="string", length=255)
	*/
	private $geoLocation;

	public function  __construct($client, $contact, $phone, $email, $location, $service, $description){
		$this->client = $client;
		$this->contact = $contact;
		$this->phone = $phone;
		$this->email = $email;
		$this->location = $location;
		$this->service = $service;
		$this->description = $description;
	}

	public function getId(){
		return $this->id;
	}

	public function getClient(){
		return $this->client;
	}

	public function getContact(){
		return $this->contact;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function getEmail(){
		return $this->email;
	}	

	public function getLocation(){
		return $this->location;
	}

	public function getService(){
		return $this->service;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setClient($client){
		$this->client = $client;
	}

	public function setContact($contact){
		$this->contact = $contact;
	}

	public function setPhone($phone){
		$this->phone = $phone;
	}

	public function setEmail($email){
		$this->email =$email
	}

	public function setLocation($location){
		$this->location = $location;
	}

	public function setService($service){
		$this->service = $service;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	}

?>