<?php

namespace MyDataLab\Bundle\ProductBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Brand
 */
class Brand
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
     *
     * @var Collection
     */
    private $retailers;

    public function __construct()
    {
        $this->retailers = new ArrayCollection();
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
     * @return Brand
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
     * @return Brand
     */
    public function setRetailers(Collection $retailers)
    {
        $this->retailers = $retailers;
        return $this;
    }

}
