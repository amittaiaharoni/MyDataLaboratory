<?php

namespace MyDataLab\Bundle\PageRoutingBundle\Entity;

use MyDataLab\Bundle\CoreBundle\Entity\Language;

/**
 * PageRouting
 */
class PageRouting
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
    private $path;

    /**
     *
     * @var Language
     */
    private $language;

    /**
     *
     * @var string
     */
    private $controller;

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
     * @return PageRouting
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
     * Set path
     *
     * @param string $path
     *
     * @return PageRouting
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get language
     * 
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set language
     * 
     * @param Language $language
     * @return PageRouting
     */
    public function setLanguage(Language $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Get controller
     * 
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set controller
     * 
     * @param string $controller
     * @return $this
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

}
