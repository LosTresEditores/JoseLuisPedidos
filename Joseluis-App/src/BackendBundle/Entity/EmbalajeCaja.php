<?php

namespace BackendBundle\Entity;

/**
 * EmbalajeCaja
 */
class EmbalajeCaja
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $observation;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \BackendBundle\Entity\Embalaje
     */
    private $idEmbalaje;


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
     * Set description
     *
     * @param string $description
     *
     * @return EmbalajeCaja
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
     * Set observation
     *
     * @param string $observation
     *
     * @return EmbalajeCaja
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return EmbalajeCaja
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
     * Set idEmbalaje
     *
     * @param \BackendBundle\Entity\Embalaje $idEmbalaje
     *
     * @return EmbalajeCaja
     */
    public function setIdEmbalaje(\BackendBundle\Entity\Embalaje $idEmbalaje = null)
    {
        $this->idEmbalaje = $idEmbalaje;

        return $this;
    }

    /**
     * Get idEmbalaje
     *
     * @return \BackendBundle\Entity\Embalaje
     */
    public function getIdEmbalaje()
    {
        return $this->idEmbalaje;
    }
}
