<?php

namespace BackendBundle\Entity;

/**
 * EmbalajePedido
 */
class EmbalajePedido
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
    private $caja;

    /**
     * @var integer
     */
    private $cantidad;

    /**
     * @var \BackendBundle\Entity\EmbalajeCaja
     */
    private $idEmbalajeCaja;

    /**
     * @var \BackendBundle\Entity\OrderDetail
     */
    private $idOrderDetail;


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
     * @return EmbalajePedido
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
     * Set caja
     *
     * @param integer $caja
     *
     * @return EmbalajePedido
     */
    public function setCaja($caja)
    {
        $this->caja = $caja;

        return $this;
    }

    /**
     * Get caja
     *
     * @return integer
     */
    public function getCaja()
    {
        return $this->caja;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return EmbalajePedido
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set idEmbalajeCaja
     *
     * @param \BackendBundle\Entity\EmbalajeCaja $idEmbalajeCaja
     *
     * @return EmbalajePedido
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
     * Set idOrderDetail
     *
     * @param \BackendBundle\Entity\OrderDetail $idOrderDetail
     *
     * @return EmbalajePedido
     */
    public function setIdOrderDetail(\BackendBundle\Entity\OrderDetail $idOrderDetail = null)
    {
        $this->idOrderDetail = $idOrderDetail;

        return $this;
    }

    /**
     * Get idOrderDetail
     *
     * @return \BackendBundle\Entity\OrderDetail
     */
    public function getIdOrderDetail()
    {
        return $this->idOrderDetail;
    }
}
