<?php

namespace MyDataLab\Bundle\RetailersBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTime;
use MyDataLab\Bundle\ProductBundle\Entity\Product;
use MyDataLab\Bundle\ProductBundle\Entity\Category;
use MyDataLab\Bundle\ProductBundle\Entity\Brand;

/**
 * Retailer
 */
class Retailer
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $productPage;

    /**
     *
     * @var Collection
     */
    private $products;

    /**
     *
     * @var Collection
     */
    private $categories;

    /**
     *
     * @var Collection
     */
    private $brands;

    /**
     *
     * @var DateTime
     */
    private $added;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->brands = new ArrayCollection();
        $this->added = new DateTime('now');
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
     * @param string $name
     *
     * @return Retailer
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
     * Set productPage
     *
     * @param string $productPage
     *
     * @return Retailer
     */
    public function setProductPage($productPage)
    {
        $this->productPage = $productPage;

        return $this;
    }

    /**
     * Get productPage
     *
     * @return string
     */
    public function getProductPage()
    {
        return $this->productPage;
    }

    /**
     * 
     * @return Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * 
     * @param Collection $products
     * @return Retailer
     */
    public function setProducts(Collection $products)
    {
        $this->products = $products;
        return $this;
    }

    /**
     * 
     * @param Product $product
     * @return $this
     */
    public function addProduct(Product $product)
    {
        $this->products->add($product);
        return $this;
    }

    /**
     * 
     * @param Product $product
     * @return Retailer
     */
    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);
        return $this;
    }

    /**
     * 
     * @return Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * 
     * @param Collection $categories
     * @return Retailer
     */
    public function setCategories(Collection $categories)
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * 
     * @param Category $category
     * @return $this
     */
    public function addCategory(Category $category)
    {
        $this->categories->add($category);
        return $this;
    }

    /**
     * 
     * @param Category $category
     * @return Retailer
     */
    public function removeCategory(Category $category)
    {
        $this->categories->removeElement($category);
        return $this;
    }

    /**
     * 
     * @param DateTime $added
     * @return Retailer
     */
    public function setAdded(DateTime $added)
    {
        $this->added = $added;
        return $this;
    }

    /**
     * 
     * @return DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * 
     * @return Collection
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * 
     * @param Collection $brands
     * @return Retailer
     */
    public function setBrands(Collection $brands)
    {
        $this->brands = $brands;
        return $this;
    }

    /**
     * 
     * @param Brand $brand
     * @return Retailer
     */
    public function addBrand(Brand $brand)
    {
        $this->brands->add($brand);
        return $this;
    }

    /**
     * 
     * @param Brand $brand
     * @return Retailer
     */
    public function removeBrand(Brand $brand)
    {
        $this->brands->removeElement($brand);
        return $this;
    }

}
