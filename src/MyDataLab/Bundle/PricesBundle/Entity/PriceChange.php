<?php

namespace MyDataLab\Bundle\PricesBundle\Entity;

use MyDataLab\Bundle\ProductBundle\Entity\Product;

/**
 * PriceChange
 */
class PriceChange
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $time;

    /**
     * @var string
     */
    private $price;

    /**
     *
     * @var Product
     */
    private $product;

    public function __construct()
    {
        $this->time = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return PriceChange
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return PriceChange
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * 
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * 
     * @param Product $product
     * @return PriceChange
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
        return $this;
    }

}
