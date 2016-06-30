<?php
namespace Finance\Entity;

use Doctrine\ORM\Mapping as ORM;

/**  
 * @ORM\Entity(repositoryClass="Finance\Entity\Repository\BankRepository")
 * @ORM\Table(name="Bank")
 */
class Bank {

	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\column(type="string",length=255, unique=true)
	*/
	protected $name;

	/**
	* @ORM\column(type="string",length=3)
	*/
	protected $number;

	/**
	* @ORM\OneToMany(targetEntity="Finance\Entity\Agency", cascade={"persist"}, mappedBy="bank")
	*/
	protected $agency;

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

	public function getAgency() {
		return $this->agency;
	}
}