<?php
namespace Purchase\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Provider {

	/** 
	*@ORM\Id
	*@ORM\GeneratedValue(strategy="AUTO")
	*@ORM\Column(type="integer")
	*/
	private $id;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $nickName;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $companyName;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $cnpj;

	/**
	* @ORM\Column(type="string",length=255,nullable=true)
	*/
	private $ie;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $im;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $street;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $number;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $neighborhood;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $city;	

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $state;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $cep;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $email;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $phone;

	public function __construct($nickName,$companyName,$cnpj,$im,$street,$number,$neighborhood,$city,$state,$cep,$phone,$email) {
		$this->nickName = $nickName;
		$this->companyName = $companyName;
		$this->cnpj = $cnpj;
		$this->im = $im;
		$this->street = $street;
		$this->number = $number;
		$this->neighborhood = $neighborhood;
		$this->city = $city;
		$this->state = $state;
		$this->cep = $cep;
		$this->phone = $phone;
		$this->email = $email;
	}


	public function getId() {
		return $this->id;
	}

	public function getNickName() {
		return $this->nickName;
	}

	public function setNickName($nickName) {
		$this->nickName = $nickName;
	}

	public function getCompanyName() {
		return $this->companyName;
	}

	public function setCompanyName($companyName) {
		$this->companyName = $companyName;
	}

	public function getCnpj() {
		return $this->cnpj;
	}

	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
	}

	public function getIe() {
		return $this->ie;
	}

	public function setIe($ie) {
		$this->ie = $ie;
	}

	public function getIm() {
		return $this->im;
	}

	public function setIm($im) {
		$this->im = $im;
	}

	public function getStreet() {
		return $this->street;
	}

	public function setStreet($street) {
		$this->street = $street;
	}

	public function getNumber() {
		return $this->number;
	}

	public function setNumber($number) {
		$this->number = $number;
	}

	public function getNeighborhood() {
		return $this->neighborhood;
	}

	public function setNeighborhood($neighborhood) {
		$this->neighborhood = $neighborhood;
	}

	public function getCity() {
		return $this->city;
	}

	public function setCity($city) {
		$this->city = $city;
	}

	public function getState() {
		return $this->state;
	}

	public function setState($state) {
		$this->state = $state;
	}

	public function getCep() {
		return $this->cep;
	}

	public function setCep($cep) {
		$this->cep = $cep;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

}