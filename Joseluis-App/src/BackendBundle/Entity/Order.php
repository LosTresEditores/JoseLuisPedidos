<?php

namespace BackendBundle\Entity;

/**
 * Order
 */
class Order
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $idUserperorder;

    /**
     * @var string
     */
    private $code;

    /**
     * @var integer
     */
    private $previousOrder;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $canceledAt;

    /**
     * @var \DateTime
     */
    private $dateApplication;

    /**
     * @var \DateTime
     */
    private $dateShip;

    /**
     * @var \DateTime
     */
    private $dateReturn;

    /**
     * @var string
     */
    private $observations;

    /**
     * @var string
     */
    private $shipName;

    /**
     * @var string
     */
    private $shipTo;

    /**
     * @var string
     */
    private $shipAddress;

    /**
     * @var string
     */
    private $shipPhone;

    /**
     * @var string
     */
    private $total;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \BackendBundle\Entity\City
     */
    private $idCity;

    /**
     * @var \BackendBundle\Entity\OrderType
     */
    private $idOrderType;

    /**
     * @var \BackendBundle\Entity\School
     */
    private $idSchool;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $idSeller;

    /**
     * @var \BackendBundle\Entity\Shipping
     */
    private $idShip;

    /**
     * @var \BackendBundle\Entity\ShippingType
     */
    private $idShipType;


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
     * Set idUserperorder
     *
     * @param integer $idUserperorder
     *
     * @return Order
     */
    public function setIdUserperorder($idUserperorder)
    {
        $this->idUserperorder = $idUserperorder;

        return $this;
    }

    /**
     * Get idUserperorder
     *
     * @return integer
     */
    public function getIdUserperorder()
    {
        return $this->idUserperorder;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Order
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
     * Set previousOrder
     *
     * @param integer $previousOrder
     *
     * @return Order
     */
    public function setPreviousOrder($previousOrder)
    {
        $this->previousOrder = $previousOrder;

        return $this;
    }

    /**
     * Get previousOrder
     *
     * @return integer
     */
    public function getPreviousOrder()
    {
        return $this->previousOrder;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Order
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Order
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set canceledAt
     *
     * @param \DateTime $canceledAt
     *
     * @return Order
     */
    public function setCanceledAt($canceledAt)
    {
        $this->canceledAt = $canceledAt;

        return $this;
    }

    /**
     * Get canceledAt
     *
     * @return \DateTime
     */
    public function getCanceledAt()
    {
        return $this->canceledAt;
    }

    /**
     * Set dateApplication
     *
     * @param \DateTime $dateApplication
     *
     * @return Order
     */
    public function setDateApplication($dateApplication)
    {
        $this->dateApplication = $dateApplication;

        return $this;
    }

    /**
     * Get dateApplication
     *
     * @return \DateTime
     */
    public function getDateApplication()
    {
        return $this->dateApplication;
    }

    /**
     * Set dateShip
     *
     * @param \DateTime $dateShip
     *
     * @return Order
     */
    public function setDateShip($dateShip)
    {
        $this->dateShip = $dateShip;

        return $this;
    }

    /**
     * Get dateShip
     *
     * @return \DateTime
     */
    public function getDateShip()
    {
        return $this->dateShip;
    }

    /**
     * Set dateReturn
     *
     * @param \DateTime $dateReturn
     *
     * @return Order
     */
    public function setDateReturn($dateReturn)
    {
        $this->dateReturn = $dateReturn;

        return $this;
    }

    /**
     * Get dateReturn
     *
     * @return \DateTime
     */
    public function getDateReturn()
    {
        return $this->dateReturn;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return Order
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
     * Set shipName
     *
     * @param string $shipName
     *
     * @return Order
     */
    public function setShipName($shipName)
    {
        $this->shipName = $shipName;

        return $this;
    }

    /**
     * Get shipName
     *
     * @return string
     */
    public function getShipName()
    {
        return $this->shipName;
    }

    /**
     * Set shipTo
     *
     * @param string $shipTo
     *
     * @return Order
     */
    public function setShipTo($shipTo)
    {
        $this->shipTo = $shipTo;

        return $this;
    }

    /**
     * Get shipTo
     *
     * @return string
     */
    public function getShipTo()
    {
        return $this->shipTo;
    }

    /**
     * Set shipAddress
     *
     * @param string $shipAddress
     *
     * @return Order
     */
    public function setShipAddress($shipAddress)
    {
        $this->shipAddress = $shipAddress;

        return $this;
    }

    /**
     * Get shipAddress
     *
     * @return string
     */
    public function getShipAddress()
    {
        return $this->shipAddress;
    }

    /**
     * Set shipPhone
     *
     * @param string $shipPhone
     *
     * @return Order
     */
    public function setShipPhone($shipPhone)
    {
        $this->shipPhone = $shipPhone;

        return $this;
    }

    /**
     * Get shipPhone
     *
     * @return string
     */
    public function getShipPhone()
    {
        return $this->shipPhone;
    }

    /**
     * Set total
     *
     * @param string $total
     *
     * @return Order
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Order
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
     * Set idCity
     *
     * @param \BackendBundle\Entity\City $idCity
     *
     * @return Order
     */
    public function setIdCity(\BackendBundle\Entity\City $idCity = null)
    {
        $this->idCity = $idCity;

        return $this;
    }

    /**
     * Get idCity
     *
     * @return \BackendBundle\Entity\City
     */
    public function getIdCity()
    {
        return $this->idCity;
    }

    /**
     * Set idOrderType
     *
     * @param \BackendBundle\Entity\OrderType $idOrderType
     *
     * @return Order
     */
    public function setIdOrderType(\BackendBundle\Entity\OrderType $idOrderType = null)
    {
        $this->idOrderType = $idOrderType;

        return $this;
    }

    /**
     * Get idOrderType
     *
     * @return \BackendBundle\Entity\OrderType
     */
    public function getIdOrderType()
    {
        return $this->idOrderType;
    }

    /**
     * Set idSchool
     *
     * @param \BackendBundle\Entity\School $idSchool
     *
     * @return Order
     */
    public function setIdSchool(\BackendBundle\Entity\School $idSchool = null)
    {
        $this->idSchool = $idSchool;

        return $this;
    }

    /**
     * Get idSchool
     *
     * @return \BackendBundle\Entity\School
     */
    public function getIdSchool()
    {
        return $this->idSchool;
    }

    /**
     * Set idSeller
     *
     * @param \BackendBundle\Entity\User $idSeller
     *
     * @return Order
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
     * Set idShip
     *
     * @param \BackendBundle\Entity\Shipping $idShip
     *
     * @return Order
     */
    public function setIdShip(\BackendBundle\Entity\Shipping $idShip = null)
    {
        $this->idShip = $idShip;

        return $this;
    }

    /**
     * Get idShip
     *
     * @return \BackendBundle\Entity\Shipping
     */
    public function getIdShip()
    {
        return $this->idShip;
    }

    /**
     * Set idShipType
     *
     * @param \BackendBundle\Entity\ShippingType $idShipType
     *
     * @return Order
     */
    public function setIdShipType(\BackendBundle\Entity\ShippingType $idShipType = null)
    {
        $this->idShipType = $idShipType;

        return $this;
    }

    /**
     * Get idShipType
     *
     * @return \BackendBundle\Entity\ShippingType
     */
    public function getIdShipType()
    {
        return $this->idShipType;
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
     * @return Order
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
    /**
     * @var string
     */
    private $guia;


    /**
     * Set guia
     *
     * @param string $guia
     *
     * @return Order
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
}
