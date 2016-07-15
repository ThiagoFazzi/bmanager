<?php
namespace Finance\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;

class StructureRepository extends EntityRepository {

	public function getStructItems() {

		$em = $this->getEntityManager();
		
		$qb = $em->createQueryBuilder('s');
		$qb->select('s')
			->from('Finance\Entity\Structure', 's');
			//->where('a.bank = :bankid')
			//->setParameter("bankid", $bankId);

		$results = $qb->getQuery()->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

	    return $results;
	}
}