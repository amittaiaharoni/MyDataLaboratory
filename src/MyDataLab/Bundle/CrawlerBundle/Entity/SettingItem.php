<?php

namespace MyDataLab\Bundle\CrawlerBundle\Entity;

use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;

/**
 * Item
 */
class SettingItem
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $selectorId;

    /**
     *
     * @var string
     */
    private $xpath;

    /**
     *
     * @var Retailer
     */
    private $retailer;

    /**
     *
     * @var string
     */
    private $image;

    public function __construct()
    {
        $this->image = false;
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
     * Set name
     *
     * @param string $selectorId
     *
     * @return SettingItem
     */
    public function setSelectorId($selectorId)
    {
        $this->selectorId = $selectorId;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getSelectorId()
    {
        return $this->selectorId;
    }

    /**
     * 
     * @return string
     */
    public function getXpath()
    {
        return $this->xpath;
    }

    /**
     * 
     * @return Retailer
     */
    public function getRetailer()
    {
        return $this->retailer;
    }

    /**
     * 
     * @param srring $xpath
     * @return SettingItem
     */
    public function setXpath($xpath)
    {
        $this->xpath = $xpath;
        return $this;
    }

    /**
     * 
     * @param Retailer $retailer
     * @return SettingItem
     */
    public function setRetailer(Retailer $retailer)
    {
        $this->retailer = $retailer;
        return $this;
    }

    /**
     * 
     * @return boolean
     */
    public function isImage()
    {
        return $this->image;
    }

    /**
     * 
     * @param boolean $image
     * @return SettingItem
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

}
