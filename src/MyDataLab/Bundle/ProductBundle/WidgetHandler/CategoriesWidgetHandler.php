<?php

namespace MyDataLab\Bundle\ProductBundle\WidgetHandler;

use MyDataLab\Bundle\WidgetBundle\WidgetHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use MyDataLab\Bundle\ProductBundle\Entity\Category;

class CategoriesWidgetHandler implements WidgetHandlerInterface
{

    const ENTITY_NAME = 'Category';
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
        return 'categories';
    }

    private function getRetailers()
    {
        return $this->manager->getRepository('MyDataLabRetailersBundle:Retailer')->findAll();
    }

    public function handle(\MyDataLab\Bundle\WidgetBundle\Entity\Widget $widget)
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
            $currentCount += count($company->getCategories());
        }
        return [
            'widget' => $widget,
            'count' => $currentCount,
            'prevCount' => $prevCount ? $prevCount->getCount() : 0,
        ];
    }

}
