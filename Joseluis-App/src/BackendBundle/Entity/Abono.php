<?php

namespace BackendBundle\Entity;

/**
 * Abono
 */
class Abono
{
    /**
     * @var integer
     */
    private $id;

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
     * @var \BackendBundle\Entity\Cartera
     */
    private $idCartera;

    /**
     * @var \BackendBundle\Entity\Consignacion
     */
    private $idConsignacion;


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
     * Set valor
     *
     * @param string $valor
     *
     * @return Abono
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
     * @return Abono
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
     * @return Abono
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
     * Set idCartera
     *
     * @param \BackendBundle\Entity\Cartera $idCartera
     *
     * @return Abono
     */
    public function setIdCartera(\BackendBundle\Entity\Cartera $idCartera = null)
    {
        $this->idCartera = $idCartera;

        return $this;
    }

    /**
     * Get idCartera
     *
     * @return \BackendBundle\Entity\Cartera
     */
    public function getIdCartera()
    {
        return $this->idCartera;
    }

    /**
     * Set idConsignacion
     *
     * @param \BackendBundle\Entity\Consignacion $idConsignacion
     *
     * @return Abono
     */
    public function setIdConsignacion(\BackendBundle\Entity\Consignacion $idConsignacion = null)
    {
        $this->idConsignacion = $idConsignacion;

        return $this;
    }

    /**
     * Get idConsignacion
     *
     * @return \BackendBundle\Entity\Consignacion
     */
    public function getIdConsignacion()
    {
        return $this->idConsignacion;
    }
}
