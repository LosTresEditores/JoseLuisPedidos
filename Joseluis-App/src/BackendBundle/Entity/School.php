<?php

namespace BackendBundle\Entity;

/**
 * School
 */
class School
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $dane;

    /**
     * @var string
     */
    private $icfes;

    /**
     * @var string
     */
    private $nit;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $web;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \BackendBundle\Entity\City
     */
    private $idCity;

    /**
     * @var \BackendBundle\Entity\School
     */
    private $idSchool;


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
     * Set dane
     *
     * @param string $dane
     *
     * @return School
     */
    public function setDane($dane)
    {
        $this->dane = $dane;

        return $this;
    }

    /**
     * Get dane
     *
     * @return string
     */
    public function getDane()
    {
        return $this->dane;
    }

    /**
     * Set icfes
     *
     * @param string $icfes
     *
     * @return School
     */
    public function setIcfes($icfes)
    {
        $this->icfes = $icfes;

        return $this;
    }

    /**
     * Get icfes
     *
     * @return string
     */
    public function getIcfes()
    {
        return $this->icfes;
    }

    /**
     * Set nit
     *
     * @param string $nit
     *
     * @return School
     */
    public function setNit($nit)
    {
        $this->nit = $nit;

        return $this;
    }

    /**
     * Get nit
     *
     * @return string
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return School
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
     * Set address
     *
     * @param string $address
     *
     * @return School
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return School
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
     * Set email
     *
     * @param string $email
     *
     * @return School
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
     * Set web
     *
     * @param string $web
     *
     * @return School
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return School
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return School
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return School
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
     * Set idCity
     *
     * @param \BackendBundle\Entity\City $idCity
     *
     * @return School
     */
    public function setIdCity(\BackendBundle\Entity\City $idCity = null)
    {
        $this->idCity = $idCity;

        return $this;
    }

    /**
     * Get idCity
     *
     * @return \BackendBundle\Entity\City
     */
    public function getIdCity()
    {
        return $this->idCity;
    }

    /**
     * Set idSchool
     *
     * @param \BackendBundle\Entity\School $idSchool
     *
     * @return School
     */
    public function setIdSchool(\BackendBundle\Entity\School $idSchool = null)
    {
        $this->idSchool = $idSchool;

        return $this;
    }

    /**
     * Get idSchool
     *
     * @return \BackendBundle\Entity\School
     */
    public function getIdSchool()
    {
        return $this->idSchool;
    }
}
