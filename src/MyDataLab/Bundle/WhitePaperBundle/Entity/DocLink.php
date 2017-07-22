<?php

namespace MyDataLab\Bundle\WhitePaperBundle\Entity;

/**
 * DocLink
 */
class DocLink
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $link;

    /**
     * @var bool
     */
    private $used = false;

    /**
     * @var WhitePaper
     */
    private $file;


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
     * Set link
     *
     * @param string $link
     *
     * @return DocLink
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set used
     *
     * @param boolean $used
     *
     * @return DocLink
     */
    public function setUsed($used)
    {
        $this->used = $used;

        return $this;
    }

    /**
     * Get used
     *
     * @return bool
     */
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * Set used
     *
     * @param WhitePaper $file
     *
     * @return DocLink
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return WhitePaper
     */
    public function getFile()
    {
        return $this->file;
    }
}

