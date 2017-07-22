<?php

namespace MyDataLab\Bundle\WidgetBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\ORM\EntityManagerInterface;
use MyDataLab\Bundle\UserBundle\Entity\User;
use MyDataLab\Bundle\WidgetBundle\Entity\DataCounter;
use MyDataLab\Bundle\ProductBundle\Entity\Product;
use MyDataLab\Bundle\ProductBundle\Entity\Category;

class LoginListener implements EventSubscriberInterface
{

    /**
     *
     * @var EntityManagerInterface
     */
    var $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onLogin',
            SecurityEvents::INTERACTIVE_LOGIN => 'onLogin',
        ];
    }

    public function onLogin(InteractiveLoginEvent $event)
    {
        /* @var $user User */
        $user = $event->getAuthenticationToken()->getUser();
//        $count = $this->manager->createQueryBuilder()
//                ->select('count(p.id)')
//                ->from('MyDataLabProductBundle:Product', 'p')
//                ->where('p.')
////                ->join('MyDataLabRetailersBundle:Retailer', 'r')
////                ->join('MydataLabUserBundle:User', 'u')
////                ->where('u.id=' . $user->getId())
//                ->getQuery()
//                ->getSingleScalarResult()
        $productsCount = 0;
        /* @var $company \MyDataLab\Bundle\RetailersBundle\Entity\Retailer */
        foreach ($user->getCompanies() as $company) {
            $productsCount += count($company->getProducts());
        }
        $prodRow = new DataCounter();
        $prodRow->setCount($productsCount)->setEntity(\MyDataLab\Bundle\ProductBundle\WidgetHandler\ProductsWidgetHandler::ENTITY_NAME)->setUser($user);
        $this->manager->persist($prodRow);


        //add categories as well
        $categoriesCount = 0;
        /* @var $company \MyDataLab\Bundle\RetailersBundle\Entity\Retailer */
        foreach ($user->getCompanies() as $company) {
            $categoriesCount += count($company->getCategories());
        }
        $categoryRow = new DataCounter();
        $categoryRow->setCount($categoriesCount)->setEntity(\MyDataLab\Bundle\ProductBundle\WidgetHandler\CategoriesWidgetHandler::ENTITY_NAME)->setUser($user);
        $this->manager->persist($categoryRow);

        //add brands
        $brandsCount = 0;
        /* @var $company \MyDataLab\Bundle\RetailersBundle\Entity\Retailer */
        foreach ($user->getCompanies() as $company) {
            $brandsCount += count($company->getBrands());
        }
        $brandsRow = new DataCounter();
        $brandsRow->setCount($brandsCount)->setEntity(\MyDataLab\Bundle\ProductBundle\WidgetHandler\BrandsWidgetHandler::ENTITY_NAME)->setUser($user);
        $this->manager->persist($brandsRow);
        //this should go to a different listener
        //all in the respective bundles - currently only ProductBundle        
        $this->manager->flush();
    }

}
