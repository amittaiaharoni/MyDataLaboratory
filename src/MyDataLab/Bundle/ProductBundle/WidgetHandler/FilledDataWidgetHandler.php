<?php

namespace MyDataLab\Bundle\ProductBundle\WidgetHandler;

use MyDataLab\Bundle\WidgetBundle\WidgetHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use MyDataLab\Bundle\ProductBundle\Entity\Product;

class FilledDataWidgetHandler implements WidgetHandlerInterface
{

    const FIELDS_COUNT = 19;

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
        return 'filled_data';
    }

    private function getRetailers()
    {
        return $this->manager->getRepository('MyDataLabRetailersBundle:Retailer')->findAll();
    }

    /**
     * @todo rewrite this via doctrine queries/metadata
     * 
     * @param Product $product
     * @return int
     */
    private function getFilledFieldsCount(Product $product)
    {
        return !is_null($product->getBrand()) +
                !empty($product->getCategories()) +
                !is_null($product->getComments()) +
                !is_null($product->getCurrency()) +
                !is_null($product->getDescription()) +
                !is_null($product->getEan13()) +
                !is_null($product->getImage()) +
                !is_null($product->getImageTitle()) +
                !is_null($product->getKeywords()) +
                !is_null($product->getPrice()) +
                !is_null($product->getPriceOld()) +
                !is_null($product->getPriceTtcHt()) +
                !is_null($product->getProductMark()) +
                !is_null($product->getReference()) +
                !is_null($product->getShipmentPrice()) +
                !is_null($product->getStockState()) +
                !is_null($product->getTitle()) +
                !is_null($product->getTypePromo()) +
                !is_null($product->getUrl());
    }

    public function handle(\MyDataLab\Bundle\WidgetBundle\Entity\Widget $widget)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $total = 0;
        $filled = 0;
        foreach ($user->getCompanies() as $company) {
            foreach ($company->getProducts() as $product) {
                $total += self::FIELDS_COUNT;
                $filled += $this->getFilledFieldsCount($product);
            }
        }
        return [
            'widget' => $widget,
            'filled' => $total ? 100 * $filled / $total : 0,
        ];
    }

}
