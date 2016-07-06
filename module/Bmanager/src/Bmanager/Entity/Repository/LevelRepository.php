<?php
namespace Bmanager\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Bmanager\Entity\Level;

class LevelRepository extends EntityRepository {

	public function createLevelCompany($company,$entityManager) {

				//var_dump($company);
				//die(); 

		for($i=1;$i<10;$i++) {
			

			$level = new Level();
			$level->setCompany($company);
			$level->setKeyLevel($i);
			$entityManager->persist($level);
			$entityManager->flush();

		}
	}
}
