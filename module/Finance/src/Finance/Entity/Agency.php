<?php
namespace Finance\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity
 */
class Agency {

	/**
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	* @ORM\Column(type="integer")
	*/
	private $id;

	/**
	* @ORM\column(type="string",length=255)
	*/
	private $name;

	/**
	* @ORM\column(type="string",length=5)
	*/
	private $number;

	/**
	* @ORM\ManyToOne(targetEntity="Finance\Entity\Bank",cascade={"all"},inversedBy="agency")
	* @ORM\JoinColumn(name="bank_id",referencedColumnName="id", nullable=false)
	*/
	private $bank;

	/**
	* @ORM\OneToMany(targetEntity="Finance\Entity\Account", mappedBy="agency")
	*/
	private $account;


	public function __construct($name,$number) {
		$this->name = $name;
		$this->number = $number;
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getNumber() {
		return $this->number;
	}

	public function setNumber($number) {
		$this->number = $number;
	}

	public function getBank() {
		return $this->bank;
	}

	public function setBank(Bank $bank) {
		$this->bank = $bank;
	}

}