<?php
namespace Finance\Entity;

use Doctrine\ORM\Mapping as ORM;

/**  
 * @ORM\Entity(repositoryClass="Finance\Entity\Repository\StructureItemRepository")
 * @ORM\Table(name="StructureItem")
 */
class StructureItem {

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