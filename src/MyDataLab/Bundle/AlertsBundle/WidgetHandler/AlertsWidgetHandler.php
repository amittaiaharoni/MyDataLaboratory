<?php

namespace MyDataLab\Bundle\AlertsBundle\WidgetHandler;

use MyDataLab\Bundle\WidgetBundle\WidgetHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use MyDataLab\Bundle\WidgetBundle\Entity\Widget;

class AlertsWidgetHandler implements WidgetHandlerInterface
{

    const ENTITY_NAME = 'Alert';

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
        return 'alerts';
    }

    public function handle(Widget $widget)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $alerts = $this->manager->getRepository('MyDataLabAlertsBundle:Alert')->findBy([
            'user' => $user,
            'read' => false,
        ]);

        return [
            'widget' => $widget,
            'alertsCount' => count($alerts),
        ];
    }

}
