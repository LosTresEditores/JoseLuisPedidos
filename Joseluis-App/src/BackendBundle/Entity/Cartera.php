<?php

namespace BackendBundle\Entity;

/**
 * Cartera
 */
class Cartera
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
     * @var \BackendBundle\Entity\Order
     */
    private $idOrder;


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
     * @return Cartera
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
     * @return Cartera
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
     * @return Cartera
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
     * @return Cartera
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
     * @return Cartera
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
     * @var string
     */
    private $abono;

    /**
     * @var string
     */
    private $pagado;


    /**
     * Set abono
     *
     * @param string $abono
     *
     * @return Cartera
     */
    public function setAbono($abono)
    {
        $this->abono = $abono;

        return $this;
    }

    /**
     * Get abono
     *
     * @return string
     */
    public function getAbono()
    {
        return $this->abono;
    }

    /**
     * Set pagado
     *
     * @param string $pagado
     *
     * @return Cartera
     */
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;

        return $this;
    }

    /**
     * Get pagado
     *
     * @return string
     */
    public function getPagado()
    {
        return $this->pagado;
    }
}
