<?php

namespace BackendBundle\Entity;

/**
 * Embalaje
 */
class Embalaje
{
    /**
     * @var integer
     */
    private $id;

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
    private $idUser;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Embalaje
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
     * @return Embalaje
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
     * Set idUser
     *
     * @param \BackendBundle\Entity\User $idUser
     *
     * @return Embalaje
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
    /**
     * @var string
     */
    private $guia;


    /**
     * Set guia
     *
     * @param string $guia
     *
     * @return Embalaje
     */
    public function setGuia($guia)
    {
        $this->guia = $guia;

        return $this;
    }

    /**
     * Get guia
     *
     * @return string
     */
    public function getGuia()
    {
        return $this->guia;
    }
    /**
     * @var \BackendBundle\Entity\Order
     */
    private $idOrder;


    /**
     * Set idOrder
     *
     * @param \BackendBundle\Entity\Order $idOrder
     *
     * @return Embalaje
     */
    public function setIdOrder(\BackendBundle\Entity\Order $idOrder = null)
    {
        $this->idOrder = $idOrder;

        return $this;
    }

    /**
     * Get idOrder
     *
     * @return \BackendBundle\Entity\Order
     */
    public function getIdOrder()
    {
        return $this->idOrder;
    }
}
