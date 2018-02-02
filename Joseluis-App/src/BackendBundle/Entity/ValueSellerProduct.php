<?php

namespace BackendBundle\Entity;

/**
 * ValueSellerProduct
 */
class ValueSellerProduct
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $priceProduct;

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
    private $state;

    /**
     * @var \BackendBundle\Entity\ProductCategory
     */
    private $idProductCategory;

    /**
     * @var \BackendBundle\Entity\SellerCategory
     */
    private $idSellerCategory;


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
     * Set priceProduct
     *
     * @param string $priceProduct
     *
     * @return ValueSellerProduct
     */
    public function setPriceProduct($priceProduct)
    {
        $this->priceProduct = $priceProduct;

        return $this;
    }

    /**
     * Get priceProduct
     *
     * @return string
     */
    public function getPriceProduct()
    {
        return $this->priceProduct;
    }

    /**
     * Set pricePremarcado
     *
     * @param string $pricePremarcado
     *
     * @return ValueSellerProduct
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
     * @return ValueSellerProduct
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
     * @return ValueSellerProduct
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
     * Set state
     *
     * @param string $state
     *
     * @return ValueSellerProduct
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
     * Set idProductCategory
     *
     * @param \BackendBundle\Entity\ProductCategory $idProductCategory
     *
     * @return ValueSellerProduct
     */
    public function setIdProductCategory(\BackendBundle\Entity\ProductCategory $idProductCategory = null)
    {
        $this->idProductCategory = $idProductCategory;

        return $this;
    }

    /**
     * Get idProductCategory
     *
     * @return \BackendBundle\Entity\ProductCategory
     */
    public function getIdProductCategory()
    {
        return $this->idProductCategory;
    }

    /**
     * Set idSellerCategory
     *
     * @param \BackendBundle\Entity\SellerCategory $idSellerCategory
     *
     * @return ValueSellerProduct
     */
    public function setIdSellerCategory(\BackendBundle\Entity\SellerCategory $idSellerCategory = null)
    {
        $this->idSellerCategory = $idSellerCategory;

        return $this;
    }

    /**
     * Get idSellerCategory
     *
     * @return \BackendBundle\Entity\SellerCategory
     */
    public function getIdSellerCategory()
    {
        return $this->idSellerCategory;
    }
}
