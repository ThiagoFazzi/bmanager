<?php
namespace Finance\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Finance\Entity\Repository\AccountTypeRepository")
 */
class AccountType {

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
	* @ORM\OneToMany(targetEntity="Finance\Entity\Account", mappedBy="accountType")
	*/
	private $account;


	public function __construct($name) {
		$this->name = $name;
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


}