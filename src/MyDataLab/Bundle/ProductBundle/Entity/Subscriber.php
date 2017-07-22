<?php

namespace MyDataLab\Bundle\ProductBundle\Entity;

/**
 * Subscriber
 */
class Subscriber
{
    /**
     * @var string
     */
    private $firstName = '0';

    /**
     * @var string
     */
    private $lastName = '0';

    /**
     * @var string
     */
    private $email = '0';

    /**
     * @var string
     */
    private $companyName = '0';

    /**
     * @var string
     */
    private $website = '0';

    /**
     * @var string
     */
    private $telephone = '0';

    /**
     * @var \DateTime
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;


    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Subscriber
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
     * @return Subscriber
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
     * @return Subscriber
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
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Subscriber
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Subscriber
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Subscriber
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Subscriber
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

