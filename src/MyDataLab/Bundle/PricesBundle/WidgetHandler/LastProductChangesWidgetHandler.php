<?php

namespace MyDataLab\Bundle\PricesBundle\WidgetHandler;

use MyDataLab\Bundle\WidgetBundle\WidgetHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use MyDataLab\Bundle\PricesBundle\Entity\PriceChange;

class LastProductChangesWidgetHandler implements WidgetHandlerInterface
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
        return 'last_product_changes';
    }

    /**
     * 
     * @return \MyDataLab\Bundle\UserBundle\Entity\User
     */
    private function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    public function handle(\MyDataLab\Bundle\WidgetBundle\Entity\Widget $widget)
    {
        $user = $this->getUser();
        $repo = $this->manager->getRepository(PriceChange::class);
        $competitors = $user->getCompetitors();
        $data = [
        ];
        $totalChanges = ['24hours' => 0, '7days' => 0,];
        foreach ($competitors as $competitor) {
            $changes7 = $repo->findAllChangesSinceTime(new \DateTime('-7 days'), $competitor);
            $changes24 = $repo->findAllChangesSinceTime(new \DateTime('-24 hours'), $competitor);
            $totalChanges['24hours'] += $changes24;
            $totalChanges['7days'] += $changes7;
            $data[] = [
                'name' => $competitor->getName(),
                'changes' => [
                    '24hours' => $changes24,
                    '7days' => $changes7,
                ],
            ];
        }
        return [
            'widget' => $widget,
            'competitors' => $data,
            'totalChanges' => $totalChanges,
        ];
    }

}
