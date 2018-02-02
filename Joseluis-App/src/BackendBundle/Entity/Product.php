<?php

namespace BackendBundle\Entity;

/**
 * Product
 */
class Product
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var string
     */
    private $price;

    /**
     * @var integer
     */
    private $existence;

    /**
     * @var integer
     */
    private $orderProducto;

    /**
     * @var integer
     */
    private $newOrder;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \BackendBundle\Entity\ProductCategory
     */
    private $idProductCategory;

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
     * Set code
     *
     * @param string $code
     *
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * @return Product
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
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set existence
     *
     * @param integer $existence
     *
     * @return Product
     */
    public function setExistence($existence)
    {
        $this->existence = $existence;

        return $this;
    }

    /**
     * Get existence
     *
     * @return integer
     */
    public function getExistence()
    {
        return $this->existence;
    }

    /**
     * Set orderProducto
     *
     * @param integer $orderProducto
     *
     * @return Product
     */
    public function setOrderProducto($orderProducto)
    {
        $this->orderProducto = $orderProducto;

        return $this;
    }

    /**
     * Get orderProducto
     *
     * @return integer
     */
    public function getOrderProducto()
    {
        return $this->orderProducto;
    }

    /**
     * Set newOrder
     *
     * @param integer $newOrder
     *
     * @return Product
     */
    public function setNewOrder($newOrder)
    {
        $this->newOrder = $newOrder;

        return $this;
    }

    /**
     * Get newOrder
     *
     * @return integer
     */
    public function getNewOrder()
    {
        return $this->newOrder;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Product
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
     * @return Product
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
     * Set idWineries
     *
     * @param \BackendBundle\Entity\Wineries $idWineries
     *
     * @return Product
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
