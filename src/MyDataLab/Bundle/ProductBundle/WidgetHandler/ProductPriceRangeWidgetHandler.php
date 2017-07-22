<?php

namespace MyDataLab\Bundle\ProductBundle\WidgetHandler;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use MyDataLab\Bundle\WidgetBundle\WidgetHandlerInterface;
use MyDataLab\Bundle\WidgetBundle\Entity\Widget;
use Doctrine\Common\Collections\ArrayCollection;
use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;

class ProductPriceRangeWidgetHandler implements WidgetHandlerInterface
{

    private static $intervals = [
        5000, 2000, 1000, 500, 400, 300, 200, 150, 100, 50, 40, 30, 20, 15, 10, 5, 0,
    ];

    /**
     *
     * @var ArrayColection[]
     */
    private $ranges;

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
        foreach (self::$intervals as $i) {
            $this->ranges[] = [
                'threshold' => $i,
                'count' => 0,
            ];
        }
    }

    public function getName()
    {
        return 'product_price_range';
    }

    private function handleCompany(Retailer $company)
    {
        foreach ($company->getProducts() as $product) {
            foreach ($this->ranges as $i => $range) {
                if ($product->getPrice() >= $range['threshold']) {
                    $this->ranges[$i]['count'] ++;
                    break;
                }
            }
        }
//        $keys = \array_keys($this->ranges);
//        foreach ($keys as $i => $threshold ) {
//            /* @var $product MyDataLab\Bundle\ProductBundle\Entity\Product */
//            foreach ($company->getProducts() as $product) {
//                if ($threshold > $product->getPrice()) {
//                    //previous range
//                    $this->ranges[$keys[$i - 1]]++;
//                    break;
//                }
//            }
//            //add to last one, that is open
//            //i.e. +5000 is the range [5000, +Infinity]
//            $this->ranges[$threshold]++;
//        }
    }

    public function handle(Widget $widget)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        foreach ($user->getCompanies() as $company) {
            $this->handleCompany($company);
        }
        $this->ranges = \array_reverse($this->ranges);
        return [
            'ranges' => $this->ranges,
            'widget' => $widget,
        ];
    }

}
