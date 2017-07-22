<?php

namespace MyDataLab\Bundle\LeadsBundle\Entity;

class ContactUsLead extends Lead
{
    /**
     *
     * @var string
     */
    private $content;

    /**
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     *
     * @param string $content
     * @return ContactUsLead
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
}