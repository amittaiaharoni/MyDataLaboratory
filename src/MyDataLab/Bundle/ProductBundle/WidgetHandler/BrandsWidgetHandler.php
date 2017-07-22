<?php

namespace MyDataLab\Bundle\ProductBundle\WidgetHandler;

use MyDataLab\Bundle\WidgetBundle\WidgetHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use MyDataLab\Bundle\WidgetBundle\Entity\Widget;

class BrandsWidgetHandler implements WidgetHandlerInterface
{

    const ENTITY_NAME = 'Brand';

    /**
     *
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     *
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $manager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->manager = $manager;
    }

    public function getName()
    {
        return 'brands';
    }

    public function handle(Widget $widget)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $prevCountRow = $this->manager->getRepository('MyDataLabWidgetBundle:DataCounter')->findBy([
            'user' => $user,
            'entity' => self::ENTITY_NAME,
                ], [
            'time' => 'DESC'
                ], 1);
        $prevCount = null;
        if (count($prevCountRow)) {
            $prevCount = $prevCountRow[0];
        }
        $currentCount = 0;
        foreach ($user->getCompanies() as $company) {
            $currentCount += count($company->getBrands());
        }
        return [
            'widget' => $widget,
            'count' => $currentCount,
            'prevCount' => $prevCount ? $prevCount->getCount() : 0,
        ];
    }

}
