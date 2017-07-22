<?php

namespace MyDataLab\Bundle\PricesBundle\Repository;

use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;
use MyDataLab\Bundle\PricesBundle\Entity\PriceChange;
use MyDataLab\Bundle\ProductBundle\Entity\Product;
use Doctrine\ORM\Query\Expr\Join;

/**
 * PriceChangeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PriceChangeRepository extends \Doctrine\ORM\EntityRepository
{

    public function findAllChangesSinceTime(\DateTime $time, Retailer $retailer)
    {
        $qb = $this->_em->createQueryBuilder();

        $result = $qb
                ->select('count(pc.id) AS c')
                ->from(PriceChange::class, 'pc')
                ->innerJoin(Product::class, 'p', Join::WITH, 'pc.product = p.id')
                ->innerJoin('p.retailers', 'r')
                ->where($qb->expr()->eq('r.id', ':retailer'))
                ->andWhere($qb->expr()->gte('pc.time', ':time'))
                ->setParameters([
                    'retailer' => $retailer->getId(),
                    'time' => $time->getTimestamp(),
                ])
                ->getQuery()
                ->getOneOrNullResult();
        return $result ? (int) $result['c'] : 0;
    }

}
