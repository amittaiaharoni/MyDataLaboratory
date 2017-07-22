<?php

namespace MyDataLab\Bundle\MarketSurveyBundle\Entity;

/**
 * MarketSurveyActivity
 */
class MarketSurveyActivity
{
    /**
     * @var int
     */
    private $id;

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
     * Set name
     *
     * @param string $name
     *
     * @return MarketSurveyActivity
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

