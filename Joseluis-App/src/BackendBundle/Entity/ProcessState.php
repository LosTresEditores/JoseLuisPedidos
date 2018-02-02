<?php

namespace BackendBundle\Entity;

/**
 * ProcessState
 */
class ProcessState
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
    private $state;

    /**
     * @var \BackendBundle\Entity\Process
     */
    private $idProcess;


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
     * @return ProcessState
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
     * Set state
     *
     * @param string $state
     *
     * @return ProcessState
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
     * Set idProcess
     *
     * @param \BackendBundle\Entity\Process $idProcess
     *
     * @return ProcessState
     */
    public function setIdProcess(\BackendBundle\Entity\Process $idProcess = null)
    {
        $this->idProcess = $idProcess;

        return $this;
    }

    /**
     * Get idProcess
     *
     * @return \BackendBundle\Entity\Process
     */
    public function getIdProcess()
    {
        return $this->idProcess;
    }
}
