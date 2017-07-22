<?php

namespace MyDataLab\Bundle\LeadsBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;

class LeadType extends AbstractType
{
    /**
     *
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
}

