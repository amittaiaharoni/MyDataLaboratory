<?php

namespace MyDataLab\Bundle\RetailersBundle\WidgetHandler;

use MyDataLab\Bundle\WidgetBundle\WidgetHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use MyDataLab\Bundle\UserBundle\Entity\User;

class AddRetailerWidgetHandler implements WidgetHandlerInterface
{

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
        return 'add_e_retailer';
    }

    private function getRetailers()
    {
        return $this->manager->getRepository('MyDataLabRetailersBundle:Retailer')->findAll();
    }
    
    /**
     * 
     * @return User
     */
    private function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    public function handle(\MyDataLab\Bundle\WidgetBundle\Entity\Widget $widget)
    {
        return [
            'widget' => $widget,
            'lastCompetitor' => $this->getUser()->getCompetitors()->last(),
//            'retailers' => $this->getRetailers(),
        ];
    }

}
