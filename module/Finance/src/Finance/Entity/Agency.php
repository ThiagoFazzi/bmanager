<?php
namespace Finance\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity(repositoryClass="Finance\Entity\Repository\AgencyRepository")
 * @ORM\Table(name="Agency")
 */
class Agency {

	/**
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	* @ORM\Column(type="integer")
	*/
	protected $id;

	/**
	* @ORM\column(type="string",length=255)
	*/
	protected $name;

	/**
	* @ORM\column(type="string",length=5)
	*/
	protected $number;

	/**
	* @ORM\ManyToOne(targetEntity="Finance\Entity\Bank", cascade={"persist"}, inversedBy="agency")
	* @ORM\JoinColumn(name="bank_id",referencedColumnName="id")
	*/
	protected $bank;

	/**
	* @ORM\OneToMany(targetEntity="Finance\Entity\Account", mappedBy="agency")
	*/
	protected $account;


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
	
	public function getAgencia() {
		return $this->name();
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