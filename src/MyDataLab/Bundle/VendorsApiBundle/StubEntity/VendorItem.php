<?php

namespace MyDataLab\Bundle\VendorsApiBundle\StubEntity;

class VendorItem
{
    private $_vendorItem;

    private $id;
    private $title;
    private $price;
    private $currency;
    private $description;
    private $img;
    private $url;

    /**
     * VendorApi constructor.
     * @param AbstractVendorItem|null $_vendorItem
     */
    function __construct($_vendorItem = null)
    {
        if($_vendorItem){
            $this->setVendorItem($_vendorItem);
        }
    }

    /**
     * @return EbayItem
     */
    public function getVendorItem()
    {
        return $this->_vendorItem;
    }

    /**
     * @param AbstractVendorItem $_vendorItem
     */
    public function setVendorItem(EbayItem $_vendorItem)
    {
        $this->_vendorItem = $_vendorItem;
        $this->setId($_vendorItem->getAliasValue('id'));
        $this->setTitle($_vendorItem->getAliasValue('title'));
        $this->setPrice($_vendorItem->getAliasValue('price'));
        $this->setCurrency($_vendorItem->getAliasValue('currency'));
        $this->setDescription($_vendorItem->getAliasValue('description'));
        $this->setImg($_vendorItem->getAliasValue('img'));
        $this->setUrl($_vendorItem->getAliasValue('url'));
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        if($this->_vendorItem){
            $this->_vendorItem->setAliasValue('id', $id);
        }
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        if($this->_vendorItem){
            $this->_vendorItem->setAliasValue('title', $title);
        }
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        if($this->_vendorItem){
            $this->_vendorItem->setAliasValue('description', $description);
        }
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        if($this->_vendorItem){
            $this->_vendorItem->setAliasValue('img', $img);
        }
        $this->img = $img;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        if($this->_vendorItem){
            $this->_vendorItem->setAliasValue('url', $url);
        }
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        if($this->_vendorItem){
            $this->_vendorItem->setAliasValue('price', $price);
        }
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        if($this->_vendorItem){
            $this->_vendorItem->setAliasValue('currency', $currency);
        }
        $this->currency = $currency;
    }
}