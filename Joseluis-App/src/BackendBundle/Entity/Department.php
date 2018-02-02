<?php

namespace BackendBundle\Entity;

/**
 * Department
 */
class Department
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $abreviation;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \BackendBundle\Entity\Country
     */
    private $idCountry;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Department
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set abreviation
     *
     * @param string $abreviation
     *
     * @return Department
     */
    public function setAbreviation($abreviation)
    {
        $this->abreviation = $abreviation;

        return $this;
    }

    /**
     * Get abreviation
     *
     * @return string
     */
    public function getAbreviation()
    {
        return $this->abreviation;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Department
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Department
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set idCountry
     *
     * @param \BackendBundle\Entity\Country $idCountry
     *
     * @return Department
     */
    public function setIdCountry(\BackendBundle\Entity\Country $idCountry = null)
    {
        $this->idCountry = $idCountry;

        return $this;
    }

    /**
     * Get idCountry
     *
     * @return \BackendBundle\Entity\Country
     */
    public function getIdCountry()
    {
        return $this->idCountry;
    }
}
