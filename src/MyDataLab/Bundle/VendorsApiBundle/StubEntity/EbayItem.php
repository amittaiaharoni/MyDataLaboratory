<?php

namespace MyDataLab\Bundle\VendorsApiBundle\StubEntity;

class EbayItem extends AbstractVendorItem
{
    /**
     * @var array
     */
    public static $propertyAlias = [
        'id' => [
            'type' => 'int',
            'elementName' => 'itemID',
            'repositoryName' => ''
        ],
        'title' => [
            'type' => 'string',
            'elementName' => 'title',
            'repositoryName' => 'keywords'
        ],
        'price' => [
            'type' => 'float',
            'elementName' => 'value',
            'repositoryName' => ''
        ],
        'currency' => [
            'type' => 'string',
            'elementName' => 'currencyId',
            'repositoryName' => ''
        ],
        'description' => [
            'type' => 'string',
            'elementName' => 'subtitle',
            'repositoryName' => ''
        ],
        'img' => [
            'type' => 'string',
            'elementName' => 'ApplicationData',
            'repositoryName' => ''
        ],
        'url' => [
            'type' => 'string',
            'elementName' => 'viewItemURL',
            'repositoryName' => ''
        ],
    ];

    /**
     * @var int
     */
    private $itemID;
    /**
     * @var string
     */
    private $title;
    /**
     * @var float
     */
    private $value;
    /**
     * @var string
     */
    private $currencyId;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $ApplicationData;
    /**
     * @var string
     */
    private $viewItemURL;

    /**
     * @param VendorItem $item
     */
    public function setItem(VendorItem $item)
    {
        $this->item = $item;
        $this->setItemID($item->getId());
        $this->setTitle($item->getTitle());
        $this->setValue($item->getPrice());
        $this->setCurrencyId($item->getCurrency());
        $this->setSubtitle($item->getDescription());
//        $this->setImg($item->getAlias('img'));
        $this->setViewItemURL($item->getUrl());
    }

    /**
     * @return int
     */
    public function getItemID()
    {
        return $this->itemID;
    }

    /**
     * @param int $itemID
     */
    public function setItemID($itemID)
    {
        if ($this->item){
            $this->item->setId($itemID);
        }
        $this->itemID = $itemID;
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
        if ($this->item){
            $this->item->setTitle($title);
        }
        $this->title = $title;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue($value)
    {
        if ($this->item){
            $this->item->setPrice($value);
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    /**
     * @param string $currencyId
     */
    public function setCurrencyId($currencyId)
    {
        if ($this->item){
            $this->item->setCurrency($currencyId);
        }
        $this->currencyId = $currencyId;
    }

    /**
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     */
    public function setSubtitle($subtitle)
    {
        if ($this->item){
            $this->item->setDescription($subtitle);
        }
        $this->subtitle = $subtitle;
    }

    /**
     * @return string
     */
    public function getApplicationData()
    {
        return $this->ApplicationData;
    }

    /**
     * @param string $ApplicationData
     */
    public function setApplicationData($ApplicationData)
    {
        if ($this->item){
            $this->item->setImg($ApplicationData);
        }
        $this->ApplicationData = $ApplicationData;
    }

    /**
     * @return string
     */
    public function getViewItemURL()
    {
        return $this->viewItemURL;
    }

    /**
     * @param string $viewItemURL
     */
    public function setViewItemURL($viewItemURL)
    {
        if ($this->item){
            $this->item->setUrl($viewItemURL);
        }
        $this->viewItemURL = $viewItemURL;
    }


}