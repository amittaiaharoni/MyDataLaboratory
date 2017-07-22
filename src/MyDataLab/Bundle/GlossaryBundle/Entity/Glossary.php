<?php

namespace MyDataLab\Bundle\GlossaryBundle\Entity;

use MyDataLab\Bundle\CoreBundle\Entity\Language;

/**
 * Glossary
 */
class Glossary
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
     * @var int
     */
    private $language;


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
     * @return Glossary
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
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     *
     * @param Language $language
     * @return Glossary
     */
    public function setLanguage(Language $language)
    {
        $this->language = $language;
        return $this;
    }
}

