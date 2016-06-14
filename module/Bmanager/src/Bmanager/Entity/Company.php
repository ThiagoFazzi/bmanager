<?php
namespace Bmanager\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;

/** @ORM\Entity */
class Company implements InputFilterAwareInterface {

	/** 
	*@ORM\Id
	*@ORM\GeneratedValue(strategy="AUTO")
	*@ORM\Column(type="integer")
	*/
	private $id;

	/**
	* @ORM\Column(type="string",length=255,nullable=true)
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
	* @ORM\Column(type="string",length=255)
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

	public function __contruct($nickName,$companyName,$cnpj,$im,$street,$number,$neighborhood,$city,$state,$cep,$phone,$email) {
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

	public function getCompanyName() {
		return $this->companyName;
	}

	public function getCnpj() {
		return $this->cnpj;
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

	public function getStreet() {
		return $this->street;
	}

	public function getNumber() {
		return $this->number;
	}

	public function getNeighborhood() {
		return $this->neighborhood;
	}

	public function getCity() {
		return $this->city;
	}

	public function getState() {
		return $this->state;
	}

	public function getCep() {
		return $this->cep;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new Exception('Você não deve invocar este método');
		
	}
	public function getInputFilter() {

		$inputFilter = new InputFilter();

		$inputFilter->add([
			'name' => 'nickName',
			'required' => true,
			'validators' => [
				[
					'name' => 'stringLength',
					'options' => [
						'min' => 3,
						'max' => 100
					]
				],

			]
		]);

		return $inputFilter;

	}	

}