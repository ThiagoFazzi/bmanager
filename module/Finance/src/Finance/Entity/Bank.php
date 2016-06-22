<?php
namespace Finance\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**  
 * @ORM\Entity
 * @ORM\Table(name="Bank")
 */
class Bank {

	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	private $id;

	/**
	* @ORM\column(type="string",length=255, unique=true)
	*/
	private $name;

	/**
	* @ORM\column(type="string",length=3)
	*/
	private $number;

	/**
	* @ORM\OneToMany(targetEntity="Finance\Entity\Agency", cascade={"all"}, mappedBy="bank", fetch="EAGER")
	*/
	private $agency;

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
}