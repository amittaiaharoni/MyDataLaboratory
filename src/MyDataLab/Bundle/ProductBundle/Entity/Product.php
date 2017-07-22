<?php

namespace MyDataLab\Bundle\ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;

/**
 * Product
 */
class Product
{

    /**
     * @var integer
     */
    private $siteid;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $keywords;

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
    private $imageTitle;

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
    private $comments;

    /**
     * @var \DateTime
     */
    private $lastUpdate;

    /**
     * @var integer
     */
    private $id;

    /**
     *
     * @var Collection
     */
    private $retailers;

    public function __construct()
    {
        $this->retailers = new ArrayCollection();
    }

    /**
     * Set siteid
     *
     * @param integer $siteid
     *
     * @return Product
     */
    public function setSiteid($siteid)
    {
        $this->siteid = $siteid;

        return $this;
    }

    /**
     * Get siteid
     *
     * @return integer
     */
    public function getSiteid()
    {
        return $this->siteid;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Product
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
     * Set url
     *
     * @param string $url
     *
     * @return Product
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Set keywords
     *
     * @param string $keywords
     *
     * @return Product
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Set imageTitle
     *
     * @param string $imageTitle
     *
     * @return Product
     */
    public function setImageTitle($imageTitle)
    {
        $this->imageTitle = $imageTitle;

        return $this;
    }

    /**
     * Get imageTitle
     *
     * @return string
     */
    public function getImageTitle()
    {
        return $this->imageTitle;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Set comments
     *
     * @param string $comments
     *
     * @return Product
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     *
     * @return Product
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
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

    /**
     * 
     * @return Collection
     */
    public function getRetailers()
    {
        return $this->retailers;
    }

    /**
     * 
     * @param Collection $retailers
     * @return $this
     */
    public function setRetailers(Collection $retailers)
    {
        $this->retailers = $retailers;
        return $this;
    }

    /**
     * 
     * @param Retailer $retailer
     * @return $this
     */
    public function addRetailer(Retailer $retailer)
    {
        $this->retailers->add($retailer);
        return $this;
    }

    /**
     * 
     * @param Retailer $retailer
     * @return $this
     */
    public function removeRetailer(Retailer $retailer)
    {
        $this->retailers->removeElement($retailer);
        return $this;
    }

}
