<?php
namespace Finance\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;

class AccountTypeRepository extends EntityRepository {


	public function getFindAccountType() {

		$em = $this->getEntityManager();
		
		$qb = $em->createQueryBuilder();
		$qb->select('at')->from('Finance\Entity\AccountType', 'at');

		$results = $qb->getQuery()->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

	    $selectData = array();

	    foreach ($results as $res) {
	        $selectData[$res['id']] = $res['name'];
	    }	

	    return $selectData;
	}
}
