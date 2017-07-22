<?php

namespace MyDataLab\Bundle\CoreBundle\Entity;

/**
 * Translation
 */
class Translation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $source;

    /**
     * @var array
     */
    private $target;

    /**
     * @var string;
     */
    private $catalogue = "messages";

    /**
     * @var Language
     */
    private $language;

    /**
     * @return mixed
     */
    public function getCatalogue()
    {
        return $this->catalogue;
    }

    /**
     * @param mixed $catalogue
     */
    public function setCatalogue($catalogue)
    {
        $this->catalogue = $catalogue;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return Translation
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set target
     *
     * @param array $target
     *
     * @return Translation
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return array
     */
    public function getTarget()
    {
        return $this->target;
    }

    public function getStatus()
    {
        if($this->getTarget()){
            return 'defined!';
        }
        return 'undefined';
    }
}

