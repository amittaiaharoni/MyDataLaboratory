<?php

namespace MyDataLab\Bundle\WidgetBundle\Entity;

use MyDataLab\Bundle\UserBundle\Entity\User;

/**
 * DataCounter
 */
class DataCounter
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $time;

    /**
     * @var int
     */
    private $count;

    /**
     * @var string
     */
    private $entity;

    /**
     *
     * @var User
     */
    private $user;

    public function __construct()
    {

        $this->time = new \DateTime('now');
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
     * Set time
     *
     * @param \DateTime $time
     *
     * @return DataCounter
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return DataCounter
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set entity
     *
     * @param string $entity
     *
     * @return DataCounter
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity
     *
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

}
