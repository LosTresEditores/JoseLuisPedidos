<?php

namespace BackendBundle\Entity;

/**
 * OrderDetail
 */
class OrderDetail
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
    private $quantityOrder;

    /**
     * @var integer
     */
    private $quantityPremarcado;

    /**
     * @var integer
     */
    private $quantityCalificado;

    /**
     * @var integer
     */
    private $quantityPlanb;

    /**
     * @var string
     */
    private $priceOrder;

    /**
     * @var string
     */
    private $pricePremarcado;

    /**
     * @var string
     */
    private $priceCalificado;

    /**
     * @var string
     */
    private $pricePlanb;

    /**
     * @var string
     */
    private $observations;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \BackendBundle\Entity\Order
     */
    private $idOrder;

    /**
     * @var \BackendBundle\Entity\Product
     */
    private $idProduct;


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
     * @return OrderDetail
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
     * Set quantityOrder
     *
     * @param integer $quantityOrder
     *
     * @return OrderDetail
     */
    public function setQuantityOrder($quantityOrder)
    {
        $this->quantityOrder = $quantityOrder;

        return $this;
    }

    /**
     * Get quantityOrder
     *
     * @return integer
     */
    public function getQuantityOrder()
    {
        return $this->quantityOrder;
    }

    /**
     * Set quantityPremarcado
     *
     * @param integer $quantityPremarcado
     *
     * @return OrderDetail
     */
    public function setQuantityPremarcado($quantityPremarcado)
    {
        $this->quantityPremarcado = $quantityPremarcado;

        return $this;
    }

    /**
     * Get quantityPremarcado
     *
     * @return integer
     */
    public function getQuantityPremarcado()
    {
        return $this->quantityPremarcado;
    }

    /**
     * Set quantityCalificado
     *
     * @param integer $quantityCalificado
     *
     * @return OrderDetail
     */
    public function setQuantityCalificado($quantityCalificado)
    {
        $this->quantityCalificado = $quantityCalificado;

        return $this;
    }

    /**
     * Get quantityCalificado
     *
     * @return integer
     */
    public function getQuantityCalificado()
    {
        return $this->quantityCalificado;
    }

    /**
     * Set quantityPlanb
     *
     * @param integer $quantityPlanb
     *
     * @return OrderDetail
     */
    public function setQuantityPlanb($quantityPlanb)
    {
        $this->quantityPlanb = $quantityPlanb;

        return $this;
    }

    /**
     * Get quantityPlanb
     *
     * @return integer
     */
    public function getQuantityPlanb()
    {
        return $this->quantityPlanb;
    }

    /**
     * Set priceOrder
     *
     * @param string $priceOrder
     *
     * @return OrderDetail
     */
    public function setPriceOrder($priceOrder)
    {
        $this->priceOrder = $priceOrder;

        return $this;
    }

    /**
     * Get priceOrder
     *
     * @return string
     */
    public function getPriceOrder()
    {
        return $this->priceOrder;
    }

    /**
     * Set pricePremarcado
     *
     * @param string $pricePremarcado
     *
     * @return OrderDetail
     */
    public function setPricePremarcado($pricePremarcado)
    {
        $this->pricePremarcado = $pricePremarcado;

        return $this;
    }

    /**
     * Get pricePremarcado
     *
     * @return string
     */
    public function getPricePremarcado()
    {
        return $this->pricePremarcado;
    }

    /**
     * Set priceCalificado
     *
     * @param string $priceCalificado
     *
     * @return OrderDetail
     */
    public function setPriceCalificado($priceCalificado)
    {
        $this->priceCalificado = $priceCalificado;

        return $this;
    }

    /**
     * Get priceCalificado
     *
     * @return string
     */
    public function getPriceCalificado()
    {
        return $this->priceCalificado;
    }

    /**
     * Set pricePlanb
     *
     * @param string $pricePlanb
     *
     * @return OrderDetail
     */
    public function setPricePlanb($pricePlanb)
    {
        $this->pricePlanb = $pricePlanb;

        return $this;
    }

    /**
     * Get pricePlanb
     *
     * @return string
     */
    public function getPricePlanb()
    {
        return $this->pricePlanb;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return OrderDetail
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return OrderDetail
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
     * @return OrderDetail
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
     * Set idProduct
     *
     * @param \BackendBundle\Entity\Product $idProduct
     *
     * @return OrderDetail
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
     * @var \BackendBundle\Entity\JlCaliidn
     */
    private $idCaliidn;


    /**
     * Set idCaliidn
     *
     * @param \BackendBundle\Entity\JlCaliidn $idCaliidn
     *
     * @return OrderDetail
     */
    public function setIdCaliidn(\BackendBundle\Entity\JlCaliidn $idCaliidn = null)
    {
        $this->idCaliidn = $idCaliidn;

        return $this;
    }

    /**
     * Get idCaliidn
     *
     * @return \BackendBundle\Entity\JlCaliidn
     */
    public function getIdCaliidn()
    {
        return $this->idCaliidn;
    }
    /**
     * @var string
     */
    private $facturado;


    /**
     * Set facturado
     *
     * @param string $facturado
     *
     * @return OrderDetail
     */
    public function setFacturado($facturado)
    {
        $this->facturado = $facturado;

        return $this;
    }

    /**
     * Get facturado
     *
     * @return string
     */
    public function getFacturado()
    {
        return $this->facturado;
    }
}
