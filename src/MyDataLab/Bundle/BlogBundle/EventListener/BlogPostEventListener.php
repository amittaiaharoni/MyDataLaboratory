<?php

namespace MyDataLab\Bundle\BlogBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use MyDataLab\Bundle\BlogBundle\Entity\Post;

class BlogPostEventListener
{

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Post) {
            return;
        }
        $entity->setUpdatedAt(new \Datetime('now'));
    }

}
