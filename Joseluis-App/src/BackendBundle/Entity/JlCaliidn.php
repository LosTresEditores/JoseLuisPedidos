<?php

namespace BackendBundle\Entity;

/**
 * JlCaliidn
 */
class JlCaliidn
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $caliidn;

    /**
     * @var integer
     */
    private $countPS1;

    /**
     * @var integer
     */
    private $countPS2;

    /**
     * @var integer
     */
    private $countCS1;

    /**
     * @var integer
     */
    private $countCS2;

    /**
     * @var \DateTime
     */
    private $dateP;

    /**
     * @var \DateTime
     */
    private $dateC;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $idUserC;

    /**
     * @var \BackendBundle\Entity\Product
     */
    private $idProduct;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $idUserP;


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
     * Set caliidn
     *
     * @param integer $caliidn
     *
     * @return JlCaliidn
     */
    public function setCaliidn($caliidn)
    {
        $this->caliidn = $caliidn;

        return $this;
    }

    /**
     * Get caliidn
     *
     * @return integer
     */
    public function getCaliidn()
    {
        return $this->caliidn;
    }

    /**
     * Set countPS1
     *
     * @param integer $countPS1
     *
     * @return JlCaliidn
     */
    public function setCountPS1($countPS1)
    {
        $this->countPS1 = $countPS1;

        return $this;
    }

    /**
     * Get countPS1
     *
     * @return integer
     */
    public function getCountPS1()
    {
        return $this->countPS1;
    }

    /**
     * Set countPS2
     *
     * @param integer $countPS2
     *
     * @return JlCaliidn
     */
    public function setCountPS2($countPS2)
    {
        $this->countPS2 = $countPS2;

        return $this;
    }

    /**
     * Get countPS2
     *
     * @return integer
     */
    public function getCountPS2()
    {
        return $this->countPS2;
    }

    /**
     * Set countCS1
     *
     * @param integer $countCS1
     *
     * @return JlCaliidn
     */
    public function setCountCS1($countCS1)
    {
        $this->countCS1 = $countCS1;

        return $this;
    }

    /**
     * Get countCS1
     *
     * @return integer
     */
    public function getCountCS1()
    {
        return $this->countCS1;
    }

    /**
     * Set countCS2
     *
     * @param integer $countCS2
     *
     * @return JlCaliidn
     */
    public function setCountCS2($countCS2)
    {
        $this->countCS2 = $countCS2;

        return $this;
    }

    /**
     * Get countCS2
     *
     * @return integer
     */
    public function getCountCS2()
    {
        return $this->countCS2;
    }

    /**
     * Set dateP
     *
     * @param \DateTime $dateP
     *
     * @return JlCaliidn
     */
    public function setDateP($dateP)
    {
        $this->dateP = $dateP;

        return $this;
    }

    /**
     * Get dateP
     *
     * @return \DateTime
     */
    public function getDateP()
    {
        return $this->dateP;
    }

    /**
     * Set dateC
     *
     * @param \DateTime $dateC
     *
     * @return JlCaliidn
     */
    public function setDateC($dateC)
    {
        $this->dateC = $dateC;

        return $this;
    }

    /**
     * Get dateC
     *
     * @return \DateTime
     */
    public function getDateC()
    {
        return $this->dateC;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return JlCaliidn
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
     * Set idUserC
     *
     * @param \BackendBundle\Entity\User $idUserC
     *
     * @return JlCaliidn
     */
    public function setIdUserC(\BackendBundle\Entity\User $idUserC = null)
    {
        $this->idUserC = $idUserC;

        return $this;
    }

    /**
     * Get idUserC
     *
     * @return \BackendBundle\Entity\User
     */
    public function getIdUserC()
    {
        return $this->idUserC;
    }

    /**
     * Set idProduct
     *
     * @param \BackendBundle\Entity\Product $idProduct
     *
     * @return JlCaliidn
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
     * Set idUserP
     *
     * @param \BackendBundle\Entity\User $idUserP
     *
     * @return JlCaliidn
     */
    public function setIdUserP(\BackendBundle\Entity\User $idUserP = null)
    {
        $this->idUserP = $idUserP;

        return $this;
    }

    /**
     * Get idUserP
     *
     * @return \BackendBundle\Entity\User
     */
    public function getIdUserP()
    {
        return $this->idUserP;
    }
}
