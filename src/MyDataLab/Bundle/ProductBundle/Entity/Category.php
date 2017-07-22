<?php

namespace MyDataLab\Bundle\ProductBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;

/**
 * Category
 */
class Category
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     *
     * @var Category
     */
    private $parent;

    /**
     *
     * @var Collection
     */
    private $children;

    /**
     *
     * @var Collection
     */
    private $retailers;

    public function __construct()
    {
        $this->retailers = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * 
     * @return Category|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * 
     * @param Category $parent
     * @return Category
     */
    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * 
     * @return Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * 
     * @param Collection $children
     * @return Category
     */
    public function setChildren(Collection $children)
    {
        $this->children = $children;
        return $this;
    }

    /**
     * 
     * @param Category $child
     * @return Category
     */
    public function addChild(Category $child)
    {
        $this->children->add($child);
        return $this;
    }
    
    /**
     * 
     * @param Category $child
     * @return Category
     */
    public function removeChild(Category $child)
    {
        $this->children->removeElement($child);
        return $this;
    }
}
