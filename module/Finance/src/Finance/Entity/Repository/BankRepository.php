<?php
namespace Finance\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;

class BankRepository extends EntityRepository {


	public function getFindBank() {

		$em = $this->getEntityManager();
		
		$qb = $em->createQueryBuilder();
		$qb->select('b')->from('Finance\Entity\Bank', 'b');

		$results = $qb->getQuery()->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

	    $selectData = array();

	    foreach ($results as $res) {
	        $selectData[$res['id']] = $res['name'];
	    }	

	    return $selectData;
	}
}
