<?php

namespace MyDataLab\Bundle\AlertsBundle\Entity;

use MyDataLab\Bundle\UserBundle\Entity\User;

/**
 * Alert
 */
class Alert
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $read;

    /**
     * @var string
     */
    private $text;

    /**
     *
     * @var User
     */
    private $user;

    /**
     *
     * @var \DateTime
     */
    private $created;

    public function __construct()
    {
        $this->created = new \DateTime('now');
        $this->read = false;
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
     * Set read
     *
     * @param boolean $read
     *
     * @return Alert
     */
    public function setRead($read)
    {
        $this->read = $read;

        return $this;
    }

    /**
     * Is read
     *
     * @return bool
     */
    public function isRead()
    {
        return $this->read;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Alert
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * 
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * 
     * @param \DateTime $created
     * @return $this
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * 
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * 
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

}
