<?php
namespace Bmanager\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Bmanager\Entity\Company as Company;

class CompanyRepository extends EntityRepository {


	public function getFindCompany() {

		$em = $this->getEntityManager();
		
		$qb = $em->createQueryBuilder();
		$qb->select('c')->from('Bmanager\Entity\Company', 'c');

		$results = $qb->getQuery()->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

	    $selectData = array();

	    foreach ($results as $res) {
	        $selectData[$res['id']] = $res['nickName'];
	    }	

	    return $selectData;
	}
}
