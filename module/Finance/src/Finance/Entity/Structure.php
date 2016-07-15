<?php
namespace Finance\Entity;

use Doctrine\ORM\Mapping as ORM;

/**  
 * @ORM\Entity(repositoryClass="Finance\Entity\Repository\StructureRepository")
 * @ORM\Table(name="Structure")
 */
class Structure {

	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\column(type="string",length=255)
	*/
	protected $item;

	/**
	* @ORM\column(type="string",length=255)
	*/
	protected $inherit;

	/**
	* @ORM\column(type="string",length=255)
	*/
	protected $level;

	public function __construct($id,$item,$inherit,$level) {
		$this->id = $id;
		$this->item = $item;
		$this->inherit = $inherit;
		$this->level = $level;
	}

	public function getId() {
		return $this->id;
	}

	public function getItem() {
		return $this->item;
	}

	public function getInherit() {
		return $this->inherit;
	}

	public function getLevel() {
		return $this->level;
	}

}