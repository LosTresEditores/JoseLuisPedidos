<?php

namespace BackendBundle\Entity;

/**
 * NotaCredito
 */
class NotaCredito
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
    private $valor;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $idSeller;


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
     * @return NotaCredito
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
     * Set valor
     *
     * @param string $valor
     *
     * @return NotaCredito
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return NotaCredito
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return NotaCredito
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
     * Set idSeller
     *
     * @param \BackendBundle\Entity\User $idSeller
     *
     * @return NotaCredito
     */
    public function setIdSeller(\BackendBundle\Entity\User $idSeller = null)
    {
        $this->idSeller = $idSeller;

        return $this;
    }

    /**
     * Get idSeller
     *
     * @return \BackendBundle\Entity\User
     */
    public function getIdSeller()
    {
        return $this->idSeller;
    }
    /**
     * @var \BackendBundle\Entity\User
     */
    private $idUser;


    /**
     * Set idUser
     *
     * @param \BackendBundle\Entity\User $idUser
     *
     * @return NotaCredito
     */
    public function setIdUser(\BackendBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \BackendBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
