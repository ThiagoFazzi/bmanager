<?php
namespace Finance\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;

class AgencyRepository extends EntityRepository {

	public function getFindAgency() {

		$em = $this->getEntityManager();
		
		$qb = $em->createQueryBuilder();
		$qb->select('a')->from('Finance\Entity\Agency', 'a');

		$results = $qb->getQuery()->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

	    $selectData = array();

	    foreach ($results as $res) {
	        $selectData[$res['id']] = $res['name'];
	    }	

	    return $selectData;
	}

	public function getFindAgencyByBank($bankId) {

		$em = $this->getEntityManager();
		
		$qb = $em->createQueryBuilder('a');
		$qb->select('a')
			->from('Finance\Entity\Agency', 'a')
			->where('a.bank = :bankid')
			->setParameter("bankid", $bankId);

		$results = $qb->getQuery()->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

	    return $results;
	}
}