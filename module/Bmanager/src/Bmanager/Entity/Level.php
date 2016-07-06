<?php
namespace Bmanager\Entity;

use Doctrine\ORM\Mapping as ORM;

/** ]
 * @ORM\Entity(repositoryClass="Bmanager\Entity\Repository\LevelRepository")
 */
class Level {

	/** 
	*@ORM\Id
	*@ORM\GeneratedValue(strategy="AUTO")
	*@ORM\Column(type="integer")
	*/
	private $id;

	/**
	* @ORM\ManyToOne(targetEntity="Bmanager\Entity\Company",inversedBy="level")
	* @ORM\JoinColumn(name="company_id",referencedColumnName="id", nullable=false)
	*/
	private $company;

	/**
	* @ORM\Column(type="integer")
	*/
	private $keyLevel;

	public function __contruct() {
	}


	public function getId() {
		return $this->id;
	}

	public function getkeyLevel() {
		return $this->keyLevel;
	}

	public function setKeyLevel($keyLevel) {
		$this->keyLevel = $keyLevel;
	}

	public function getCompany() {
		return $this->company;
	}

	public function setCompany(Company $company) {
		$this->company = $company;
	}

}