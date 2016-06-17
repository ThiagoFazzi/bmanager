<?php
namespace Finance\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity **/
class Bank {

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
	* @ORM\column(type="string",length=3)
	*/
	private $number;

	/**
	* @ORM\OneToMany(targetEntity="Finance\Entity\Agency", mappedBy="bank")
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