<?php

namespace MyDataLab\Bundle\MarketSurveyBundle\Entity;

/**
 * MarketSurveyCategory
 */
class MarketSurveyCategory
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var MarketSurveyCategory
     */
    private $parentCategory;

    /**
     * @var string
     */
    private $name;

    function __toString()
    {
        return $this->getName();
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
     * @return MarketSurveyCategory|null
     */
    public function getParentCategory()
    {
        return $this->parentCategory;
    }

    /**
     * @param MarketSurveyCategory $parentCategory
     */
    public function setParentCategory(MarketSurveyCategory $parentCategory)
    {
        $this->parentCategory = $parentCategory;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return MarketSurveyCategory
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
}

