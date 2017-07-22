<?php

namespace MyDataLab\Bundle\ProductBundle\Entity;

/**
 * GlobalTag
 */
class GlobalTag
{

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var string
     */
    private $categories;

    /**
     * @var string
     */
    private $ean13;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $priceOld;

    /**
     * @var string
     */
    private $typePromo;

    /**
     * @var string
     */
    private $priceTtcHt;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $shipmentPrice;

    /**
     * @var string
     */
    private $stockState;

    /**
     * @var string
     */
    private $productMark;

    /**
     * @var string
     */
    private $breadcrumb;

    /**
     * @var integer
     */
    private $id;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return GlobalTag
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return GlobalTag
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return GlobalTag
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set categories
     *
     * @param string $categories
     *
     * @return GlobalTag
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return string
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set ean13
     *
     * @param string $ean13
     *
     * @return GlobalTag
     */
    public function setEan13($ean13)
    {
        $this->ean13 = $ean13;

        return $this;
    }

    /**
     * Get ean13
     *
     * @return string
     */
    public function getEan13()
    {
        return $this->ean13;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return GlobalTag
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return GlobalTag
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return GlobalTag
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
     * Set priceOld
     *
     * @param string $priceOld
     *
     * @return GlobalTag
     */
    public function setPriceOld($priceOld)
    {
        $this->priceOld = $priceOld;

        return $this;
    }

    /**
     * Get priceOld
     *
     * @return string
     */
    public function getPriceOld()
    {
        return $this->priceOld;
    }

    /**
     * Set typePromo
     *
     * @param string $typePromo
     *
     * @return GlobalTag
     */
    public function setTypePromo($typePromo)
    {
        $this->typePromo = $typePromo;

        return $this;
    }

    /**
     * Get typePromo
     *
     * @return string
     */
    public function getTypePromo()
    {
        return $this->typePromo;
    }

    /**
     * Set priceTtcHt
     *
     * @param string $priceTtcHt
     *
     * @return GlobalTag
     */
    public function setPriceTtcHt($priceTtcHt)
    {
        $this->priceTtcHt = $priceTtcHt;

        return $this;
    }

    /**
     * Get priceTtcHt
     *
     * @return string
     */
    public function getPriceTtcHt()
    {
        return $this->priceTtcHt;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return GlobalTag
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set shipmentPrice
     *
     * @param string $shipmentPrice
     *
     * @return GlobalTag
     */
    public function setShipmentPrice($shipmentPrice)
    {
        $this->shipmentPrice = $shipmentPrice;

        return $this;
    }

    /**
     * Get shipmentPrice
     *
     * @return string
     */
    public function getShipmentPrice()
    {
        return $this->shipmentPrice;
    }

    /**
     * Set stockState
     *
     * @param string $stockState
     *
     * @return GlobalTag
     */
    public function setStockState($stockState)
    {
        $this->stockState = $stockState;

        return $this;
    }

    /**
     * Get stockState
     *
     * @return string
     */
    public function getStockState()
    {
        return $this->stockState;
    }

    /**
     * Set productMark
     *
     * @param string $productMark
     *
     * @return GlobalTag
     */
    public function setProductMark($productMark)
    {
        $this->productMark = $productMark;

        return $this;
    }

    /**
     * Get productMark
     *
     * @return string
     */
    public function getProductMark()
    {
        return $this->productMark;
    }

    /**
     * Set breadcrumb
     *
     * @param string $breadcrumb
     *
     * @return GlobalTag
     */
    public function setBreadcrumb($breadcrumb)
    {
        $this->breadcrumb = $breadcrumb;

        return $this;
    }

    /**
     * Get breadcrumb
     *
     * @return string
     */
    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

}
