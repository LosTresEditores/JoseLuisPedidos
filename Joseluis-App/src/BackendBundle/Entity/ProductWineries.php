<?php

namespace BackendBundle\Entity;

/**
 * ProductWineries
 */
class ProductWineries
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
     * @var integer
     */
    private $quantity;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \BackendBundle\Entity\Product
     */
    private $idProduct;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $idUser;

    /**
     * @var \BackendBundle\Entity\Wineries
     */
    private $idWineries;


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
     * @return ProductWineries
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return ProductWineries
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ProductWineries
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
     * @return ProductWineries
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
     * Set idProduct
     *
     * @param \BackendBundle\Entity\Product $idProduct
     *
     * @return ProductWineries
     */
    public function setIdProduct(\BackendBundle\Entity\Product $idProduct = null)
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    /**
     * Get idProduct
     *
     * @return \BackendBundle\Entity\Product
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /**
     * Set idUser
     *
     * @param \BackendBundle\Entity\User $idUser
     *
     * @return ProductWineries
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
     * Set idWineries
     *
     * @param \BackendBundle\Entity\Wineries $idWineries
     *
     * @return ProductWineries
     */
    public function setIdWineries(\BackendBundle\Entity\Wineries $idWineries = null)
    {
        $this->idWineries = $idWineries;

        return $this;
    }

    /**
     * Get idWineries
     *
     * @return \BackendBundle\Entity\Wineries
     */
    public function getIdWineries()
    {
        return $this->idWineries;
    }
}
