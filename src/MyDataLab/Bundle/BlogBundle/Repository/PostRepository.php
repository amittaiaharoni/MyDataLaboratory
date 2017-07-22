<?php

namespace MyDataLab\Bundle\BlogBundle\Repository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{

    public function findByLocale($locale = 'en')
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')
                ->from($this->getEntityName(), 'p')
                ->join('p.language', 'l')
                ->where('l.code=:code')
                ->setParameter('code', $locale)
        ;
        return $qb->getQuery()->getResult();
    }

}
