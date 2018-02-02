<?php

namespace BackendBundle\Entity;

/**
 * EmbCajaOrder
 */
class EmbCajaOrder
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \BackendBundle\Entity\EmbalajeCaja
     */
    private $idEmbalajeCaja;

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
     * Set state
     *
     * @param string $state
     *
     * @return EmbCajaOrder
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
     * Set idEmbalajeCaja
     *
     * @param \BackendBundle\Entity\EmbalajeCaja $idEmbalajeCaja
     *
     * @return EmbCajaOrder
     */
    public function setIdEmbalajeCaja(\BackendBundle\Entity\EmbalajeCaja $idEmbalajeCaja = null)
    {
        $this->idEmbalajeCaja = $idEmbalajeCaja;

        return $this;
    }

    /**
     * Get idEmbalajeCaja
     *
     * @return \BackendBundle\Entity\EmbalajeCaja
     */
    public function getIdEmbalajeCaja()
    {
        return $this->idEmbalajeCaja;
    }

    /**
     * Set idOrder
     *
     * @param \BackendBundle\Entity\Order $idOrder
     *
     * @return EmbCajaOrder
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
     * @var \BackendBundle\Entity\Embalaje
     */
    private $idEmbalaje;


    /**
     * Set idEmbalaje
     *
     * @param \BackendBundle\Entity\Embalaje $idEmbalaje
     *
     * @return EmbCajaOrder
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
