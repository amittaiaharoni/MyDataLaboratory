<?php

namespace MyDataLab\Bundle\LeadsBundle\Entity;


use MyDataLab\Bundle\WhitePaperBundle\Entity\WhitePaper;

class WhitePaperLead extends Lead
{

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $jobTitle;

    /**
     * @var string
     */
    private $country;

    /**
     *
     * @var WhitePaper
     */
    private $leadSource;

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Lead
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Lead
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
     * Set jobTitle
     *
     * @param string $jobTitle
     *
     * @return Lead
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get jobTitle
     *
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Lead
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     *
     * @return WhitePaper
     */
    public function getLeadSource()
    {
        return $this->leadSource;
    }

    /**
     *
     * @param WhitePaper $whitePaper
     * @return WhitePaperLead
     */
    public function setLeadSource(WhitePaper $whitePaper)
    {
        $this->leadSource = $whitePaper;
        return $this;
    }
}