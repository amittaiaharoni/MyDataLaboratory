<?php

namespace MyDataLab\Bundle\CoreBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\ResultSetMapping;
use MyDataLab\Bundle\CoreBundle\Entity\Language;
use Doctrine\ORM\EntityRepository;
use MyDataLab\Bundle\CoreBundle\Entity\Translation;

class TranslationRepository extends EntityRepository
{

    /**
     * Return all translations for specified token
     * @param type $token
     * @param type $domain
     */
    public function getTranslations(Language $language, $catalogue = "messages")
    {
        $query = $this->getEntityManager()->createQuery("SELECT t FROM MyDataLabCoreBundle:Translation t WHERE t.language = :language AND t.catalogue = :catalogue");
        $query->setParameter("language", $language);
        $query->setParameter("catalogue", $catalogue);

        return $query->getResult();
    }

    public function findAllSources($locale = 'en')
    {
        $language = $this->getEntityManager()->getRepository('MyDataLabCoreBundle:Language')->findOneBy(['code' => $locale]);
        $qb1 = $this->getEntityManager()->createQueryBuilder();
        $qb2 = $this->getEntityManager()->createQueryBuilder();

        $sources = $qb1->select('v')
            ->from('MyDataLabCoreBundle:Translation', 'v')
            ->groupBy('v.source')
            ->getQuery()->getResult();

        $targets = $qb2->select('u')
                ->from('MyDataLabCoreBundle:Translation', 'u')
                ->where($qb2->expr()->eq('u.language', $language->getId()))
            ->getQuery()->getResult();

        $translations = [];
        foreach ($sources as $source){
            if($target = $this->findObjectBySource($source->getSource(), $targets)){
                $source->setTarget($target->getTarget());
            }
            else{
                $source->setTarget(null);
            }
            $translations[] = $source;
        }

        return $translations;
    }

    private function findObjectBySource($source, $targets){
        foreach ( $targets as $element ) {
            if ( $source == $element->getSource() ) {
                return $element;
            }
        }

        return false;
    }
}