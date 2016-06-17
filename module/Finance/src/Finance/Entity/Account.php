<?php
namespace Finance\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity **/
class Account {

	/**
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	* @ORM\Column(type="integer")
	*/
	private $id;

	/**
	* @ORM\column(type="string",length=255)
	*/
	private $number;

	/**
	* @ORM\ManyToOne(targetEntity="Finance\Entity\Agency",inversedBy="account")
	* @ORM\JoinColumn(name="agency_id",referencedColumnName="id", nullable=false)
	*/
	private $agency;

	/**
	* @ORM\ManyToOne(targetEntity="Finance\Entity\AccountType",inversedBy="account")
	* @ORM\JoinColumn(name="accountType_id",referencedColumnName="id", nullable=false)
	*/
	private $accountType;

	/**
	* @ORM\ManyToOne(targetEntity="Bmanager\Entity\Company",inversedBy="account")
	* @ORM\JoinColumn(name="company_id",referencedColumnName="id", nullable=false)
	*/
	private $company;

	public function __construct($name,$number) {
		$this->name = $name;
		$this->number = $number;
	}

	public function getId() {
		return $this->id;
	}

	public function getNumber() {
		return $this->number;
	}

	public function setNumber($number) {
		$this->number = $number;
	}

	public function getAgency() {
		return $this->agency;
	}

	public function setAgency(Agency $agency) {
		$this->agency = $agency;
	}

	public function getAccountType() {
		return $this->accountType;
	}

	public function setAccounType(AccountType $accountType) {
		$this->accountType = $accountType;
	}

	public function getCompany() {
		return $this->company;
	}

	public function setCompany(Company $company) {
		$this->company = $company;
	}

}