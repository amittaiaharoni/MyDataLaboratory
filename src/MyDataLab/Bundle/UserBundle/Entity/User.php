<?php

namespace MyDataLab\Bundle\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;
use MyDataLab\Bundle\AlertsBundle\Entity\Alert;

/**
 * User
 */
class User extends BaseUser
{

    const STATUS_RETAILER = 'retailer';
    const STATUS_BRAND = 'brand';
    const STATUS_AGENCY = 'agency';
    const STATUS_OTHER = 'other';

    /**
     * @var int
     */
    protected $id;

    /**
     *
     * @var Collection
     */
    private $widgets;

    /**
     *
     * @var Collection
     */
    private $companies;

    /**
     *
     * @var string
     */
    private $status;

    /**
     *
     * @var Collection
     */
    private $competitors;

    /**
     *
     * @var Collection
     */
    private $alerts;

    public function __construct()
    {
        parent::__construct();
        $this->status = self::STATUS_OTHER;
        $this->widgets = new ArrayCollection();
        $this->companies = new ArrayCollection();
        $this->competitors = new ArrayCollection();
        $this->alerts = new ArrayCollection();
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
     * Set id
     * 
     * @param int $id
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * 
     * @return Collection
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * 
     * @param Collection $widgets
     * @return $this
     */
    public function setWidgets(Collection $widgets)
    {
        $this->widgets = $widgets;
        return $this;
    }

    /**
     * 
     * @return Collection
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * 
     * @param Collection $companies
     * @return $this
     */
    public function setCompanies(Collection $companies)
    {
        $this->companies = $companies;
        return $this;
    }

    /**
     * 
     * @return Collection
     */
    public function getCompetitors()
    {
        return $this->competitors;
    }

    /**
     * 
     * @param Collection $competitors
     * @return $this
     */
    public function setCompetitors(Collection $competitors)
    {
        $this->competitors = $competitors;
        return $this;
    }

    /**
     * 
     * @param Retailer $competitor
     * @return $this
     */
    public function addCompetitor(Retailer $competitor)
    {
        $this->competitors->add($competitor);
        return $this;
    }

    /**
     * 
     * @param Retailer $competitor
     * @return $this
     */
    public function removeCompetitor(Retailer $competitor)
    {
        $this->competitors->removeElement($competitor);
        return $this;
    }

    /**
     * 
     * @return Collection
     */
    public function getAlerts()
    {
        return $this->alerts;
    }

    /**
     * 
     * @param Collection $alerts
     * @return $this
     */
    public function setAlerts(Collection $alerts)
    {
        $this->alerts = $alerts;
        return $this;
    }

    /**
     * 
     * @param Alert $alert
     * @return $this
     */
    public function addAlert(Alert $alert)
    {
        $this->alerts->add($alert);
        return $this;
    }

    /**
     * 
     * @param Alert $alert
     * @return $this
     */
    public function removeAlert(Alert $alert)
    {
        $this->alerts->removeElement($alert);
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}
