<?php

namespace MyDataLab\Bundle\CoreBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;

class LanguageProvider
{

    /**
     *
     * @var ObjectManager
     */
    private $manager;

    /**
     *
     * @var string
     */
    private $langaugeClass;

    public function __construct(ObjectManager $manager, $langaugeClass)
    {
        $this->manager = $manager;
        $this->langaugeClass = $langaugeClass;
    }

    public function getLanguages()
    {
        return $this->manager->getRepository($this->langaugeClass)->findAll();
    }

}
