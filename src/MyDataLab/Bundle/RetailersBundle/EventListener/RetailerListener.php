<?php

namespace MyDataLab\Bundle\RetailersBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;

class RetailerListener
{

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Retailer) {
            return;
        }
        $parts = \parse_url($entity->getProductPage());
        $entity->setName($parts['host']);
    }

}
