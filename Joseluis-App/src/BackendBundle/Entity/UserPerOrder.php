<?php

namespace BackendBundle\Entity;

/**
 * UserPerOrder
 */
class UserPerOrder
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
     * @var \BackendBundle\Entity\Order
     */
    private $idOrder;

    /**
     * @var \BackendBundle\Entity\ProcessState
     */
    private $idProcessState;

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
     * @return UserPerOrder
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
     * @return UserPerOrder
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
     * Set idOrder
     *
     * @param \BackendBundle\Entity\Order $idOrder
     *
     * @return UserPerOrder
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

    /**
     * Set idProcessState
     *
     * @param \BackendBundle\Entity\ProcessState $idProcessState
     *
     * @return UserPerOrder
     */
    public function setIdProcessState(\BackendBundle\Entity\ProcessState $idProcessState = null)
    {
        $this->idProcessState = $idProcessState;

        return $this;
    }

    /**
     * Get idProcessState
     *
     * @return \BackendBundle\Entity\ProcessState
     */
    public function getIdProcessState()
    {
        return $this->idProcessState;
    }

    /**
     * Set idUser
     *
     * @param \BackendBundle\Entity\User $idUser
     *
     * @return UserPerOrder
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
