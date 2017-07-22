<?php

namespace MyDataLab\Bundle\LeadsBundle\Entity;


use MyDataLab\Bundle\CoreBundle\Entity\Language;

abstract class Lead
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     *
     * @var Language
     */
    private $locale;

    /**
     *
     * @var \DateTime
     */
    private $addedAt;

    public function __construct()
    {
        $this->addedAt = new \DateTime('now');
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Lead
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Lead
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Lead
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @return Language
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**leadSource
     *
     * @param Language $locale
     * @return Lead
     */
    public function setLocale(Language $locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }
}