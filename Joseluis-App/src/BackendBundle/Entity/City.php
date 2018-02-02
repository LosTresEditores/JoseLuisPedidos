<?php

namespace BackendBundle\Entity;

/**
 * City
 */
class City
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
     * @var \BackendBundle\Entity\Department
     */
    private $idDepartments;


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
     * @return City
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
     * @return City
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
     * @return City
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
     * @return City
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
     * Set idDepartments
     *
     * @param \BackendBundle\Entity\Department $idDepartments
     *
     * @return City
     */
    public function setIdDepartments(\BackendBundle\Entity\Department $idDepartments = null)
    {
        $this->idDepartments = $idDepartments;

        return $this;
    }

    /**
     * Get idDepartments
     *
     * @return \BackendBundle\Entity\Department
     */
    public function getIdDepartments()
    {
        return $this->idDepartments;
    }
}
