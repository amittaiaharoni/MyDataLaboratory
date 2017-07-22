<?php

namespace MyDataLab\Bundle\MarketSurveyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use MyDataLab\Bundle\ProductBundle\Entity\Brand;
use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;

/**
 * MarketSurvey
 */
class MarketSurvey
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
     * @var MarketSurveyActivity[]
     */
    private $activity;

    /**
     * @var MarketSurveyCategory[]
     */
    private $categoriesArray;

    /**
     * @var \DateTime
     */
    private $timeSlotStart;

    /**
     * @var \DateTime
     */
    private $timeSlotEnd;

    /**
     * @var Retailer[]
     */
    private $retailers;

    /**
     * @var MarketSurveyMarketPlace[]
     */
    private $marketPlaces;

    /**
     * @var Brand[]
     */
    private $brands;

    /**
     * MarketSurvey constructor.
     */
    function __construct()
    {
        $this->activity = new ArrayCollection();
        $this->categoriesArray = new ArrayCollection();
        $this->retailers = new ArrayCollection();
        $this->marketPlaces = new ArrayCollection();
        $this->brands = new ArrayCollection();
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
     * @return MarketSurvey
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
     * Set activity
     *
     * @param Collection $activity
     *
     * @return MarketSurvey
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return Collection
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set main categories
     *
     * @param MarketSurveyCategory[] $categories
     *
     * @return MarketSurvey
     */
    public function setMainCategories($categories)
    {
        $categoriesArray = $this->categoriesArray;
        if($this->categoriesArray instanceof ArrayCollection && $this->categoriesArray->isEmpty()){
            $categoriesArray = [];
        }
        if($this->validateCategoriesArray($categories, 'mainCategories')){
            $this->categoriesArray = $this->disjunctCategories($categories, $categoriesArray);
            $this->categoriesArray = new ArrayCollection( $this->categoriesArray + $categories);
            return $this;
        }
    }

    /**
     * Get main categories
     *
     * @return MarketSurveyCategory[]
     */
    public function getMainCategories()
    {
        return $this->getCategoriesArray('mainCategories');
    }

    /**
     * Set main categories
     *
     * @param MarketSurveyCategory[] $categories
     *
     * @return MarketSurvey
     */
    public function setCategories($categories)
    {
        if($this->validateCategoriesArray($categories, 'categories')){
            $this->categoriesArray = $this->disjunctCategories($categories, $this->categoriesArray->toArray());
            $this->categoriesArray = new ArrayCollection($this->categoriesArray + $categories);
            return $this;
        }

    }

    /**
     * get main categories
     *
     * @return MarketSurveyCategory[] $categories
     */
    public function getCategories()
    {
        return $this->getCategoriesArray('categories');
    }

    /**
     * Set subcategories
     *
     * @param MarketSurveyCategory[] $categories
     *
     * @return MarketSurvey
     */
    public function setSubCategories($categories)
    {
        if($this->validateCategoriesArray($categories, 'subCategories')){
            $this->categoriesArray = $this->disjunctCategories($categories, $this->categoriesArray->toArray());
            $this->categoriesArray = new ArrayCollection($this->categoriesArray + $categories);
            return $this;
        }
    }

    /**
     * Set categories
     *
     * @return MarketSurveyCategory[] $categories
     */
    public function getSubCategories()
    {
        return $this->getCategoriesArray('subCategories');
    }

    /**
     * Set timeSlotStart
     *
     * @param \DateTime $timeSlotStart
     *
     * @return MarketSurvey
     */
    public function setTimeSlotStart($timeSlotStart)
    {
        $this->timeSlotStart = $timeSlotStart;

        return $this;
    }

    /**
     * Get timeSlotStart
     *
     * @return \DateTime
     */
    public function getTimeSlotStart()
    {
        return $this->timeSlotStart;
    }

    /**
     * Set timeSlotEnd
     *
     * @param \DateTime $timeSlotEnd
     *
     * @return MarketSurvey
     */
    public function setTimeSlotEnd($timeSlotEnd)
    {
        $this->timeSlotEnd = $timeSlotEnd;

        return $this;
    }

    /**
     * Get timeSlotEnd
     *
     * @return \DateTime
     */
    public function getTimeSlotEnd()
    {
        return $this->timeSlotEnd;
    }

    /**
     * Set retailers
     *
     * @param Collection $retailers
     *
     * @return MarketSurvey
     */
    public function setRetailers($retailers)
    {
        $this->retailers = $retailers;

        return $this;
    }

    /**
     * Get retailers
     *
     * @return Collection
     */
    public function getRetailers()
    {
        return $this->retailers;
    }

    /**
     * Set marketPlaces
     *
     * @param Collection $marketPlaces
     *
     * @return MarketSurvey
     */
    public function setMarketPlaces($marketPlaces)
    {
        $this->marketPlaces = $marketPlaces;

        return $this;
    }

    /**
     * Get marketPlaces
     *
     * @return Collection
     */
    public function getMarketPlaces()
    {
        return $this->marketPlaces;
    }

    /**
     * Set brands
     *
     * @param Collection $brands
     *
     * @return MarketSurvey
     */
    public function setBrands($brands)
    {
        $this->brands = $brands;

        return $this;
    }

    /**
     * Get brands
     *
     * @return Collection
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * @param MarketSurveyCategory[] $categories
     * @param string $type
     */
    public function setCategoriesArray($categories, $type)
    {
        if($type === 'main'){
            foreach ($this->categoriesArray as $key => $value){

            }
        }
    }

    /**
     * @param string|null $type
     * @return ArrayCollection|MarketSurveyCategory[]
     */
    public function getCategoriesArray($type = null)
    {
        if($this->categoriesArray instanceof ArrayCollection && $this->categoriesArray->isEmpty()){
            return $this->categoriesArray;
        }
        $parentType = $this->getParentType($type);
        if($parentType){
            $parentCategories = $this->{'get'.$parentType}();
            $parentCategoriesId = $this->generateCategoriesIdsArray($parentCategories);
        }
        else if($parentType === null){
            $parentCategoriesId = [null];

        }
        else{
            return $this->categoriesArray;
        }

        $categories = [];
        foreach ($this->categoriesArray as $category) {
            $categoryId = (is_null($id = $category->getParentCategory()))? $id : $category->getParentCategory()->getId();
            if (in_array($categoryId, $parentCategoriesId)) {
                $categories[] = $category;
            }
        }

        return $categories;
    }

    /**
     * @param MarketSurveyCategory[] $categories
     * @param string $type
     * @return bool
     */
    private function validateCategoriesArray($categories, $type)
    {
        $parentType = $this->getParentType($type);
        if($parentType){
            $parentCategories = $this->{'get'.$parentType}();
            $parentCategoriesId = $this->generateCategoriesIdsArray($parentCategories);

        }
        else{
            $parentCategoriesId = [null];
        }

        foreach ($categories as $category) {
            $categoryId = (is_null($id = $category->getParentCategory()))? $id : $category->getParentCategory()->getId();
            if (!in_array($categoryId, $parentCategoriesId)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param string $type
     * @return null|string
     */
    private function getParentType($type)
    {
        if($type === 'mainCategories'){
            return null;
        }
        else if($type === 'categories'){
            return 'MainCategories';
        }
        else if($type === 'subCategories'){
            return 'Categories';
	    }
	    else{
            return false;
        }
    }

    /**
     * @param MarketSurveyCategory[] $category1
     * @param MarketSurveyCategory[] $category2
     *
     * @return MarketSurveyCategory[]
     */
    private function disjunctCategories($category1, $category2)
    {
        return array_unique(array_merge($category1, $category2));
    }

    /**
     * @param MarketSurveyCategory[] $parentCategories
     *
     * @return array
     */
    private function generateCategoriesIdsArray($parentCategories)
    {
        /**
         * @param MarketSurveyCategory $a
         * @return string
         */
        $mapParent = function($a){
            return $a->getId();
        };

        return array_map($mapParent, $parentCategories);
    }

}

