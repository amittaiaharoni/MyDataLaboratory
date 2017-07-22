<?php

namespace MyDataLab\Bundle\VendorsApiBundle\StubEntity;


class PriceMinisterItem extends AbstractVendorItem
{
    /**
     * @var array
     */
    public static $propertyAlias = [
        'id' => [
            'type' => 'int',
            'elementName' => 'id',
            'repositoryName' => ''
        ],
        'title' => [
            'type' => 'string',
            'elementName' => 'name',
            'repositoryName' => 'kw'
        ],
        'price' => [
            'type' => 'float',
            'elementName' => '',
            'repositoryName' => ''
        ],
        'currency' => [
            'type' => 'string',
            'elementName' => '',
            'repositoryName' => ''
        ],
        'description' => [
            'type' => 'string',
            'elementName' => '',
            'repositoryName' => ''
        ],
        'img' => [
            'type' => 'string',
            'elementName' => 'image',
            'repositoryName' => ''
        ],
        'url' => [
            'type' => 'string',
            'elementName' => 'url',
            'repositoryName' => ''
        ],
    ];

    private $id;
    private $name;
    private $image;
    private $url;

    /**
     * @param VendorItem $item
     */
    public function setItem(VendorItem $item)
    {
        $this->item = $item;
        $this->setId($item->getId());
        $this->setName($item->getTitle());
        $this->setImage($item->getImg());
        $this->setUrl($item->getUrl());
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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
        $this->url = $url;
    }

}