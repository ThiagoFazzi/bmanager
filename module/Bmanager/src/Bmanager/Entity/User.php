<?php
namespace Bmanager\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class User {

	/** 
	*@ORM\Id
	*@ORM\GeneratedValue(strategy="AUTO")
	*@ORM\Column(type="integer")
	*/
	private $id;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $userName;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $email;

	/**
	* @ORM\Column(type="string",length=255)
	*/
	private $password;

	public function __contruct($userName,$password) {
		$this->userName = $userName;
		$this->password = $password;
	}


	public function getId() {
		return $this->id;
	}

	public function getUserName() {
		return $this->userName;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getPassword() {
		return $this->password;
	}

}