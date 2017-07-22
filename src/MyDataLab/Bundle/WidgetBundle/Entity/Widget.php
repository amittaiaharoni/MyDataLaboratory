<?php

namespace MyDataLab\Bundle\WidgetBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Widget
 */
class Widget
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
    private $position;

    /**
     *
     * @var string
     */
    private $parent;

    /**
     *
     * @var UserInterface
     */
    private $user;

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
     * @return Widget
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
     * Set position
     *
     * @param integer $position
     *
     * @return UserWidget
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * 
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * 
     * @param UserInterface $user
     * @return Widget
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * 
     * @param type $parent
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * 
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

}
