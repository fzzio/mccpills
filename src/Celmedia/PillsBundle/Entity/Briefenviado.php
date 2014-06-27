<?php

namespace Celmedia\PillsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Briefenviado
 */
class Briefenviado
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fechaenvio;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var \Celmedia\PillsBundle\Entity\User
     */
    private $usuario;

    /**
     * @var \Celmedia\PillsBundle\Entity\Pillbrief
     */
    private $pillbrief;


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
     * Set fechaenvio
     *
     * @param \DateTime $fechaenvio
     * @return Briefenviado
     */
    public function setFechaenvio($fechaenvio)
    {
        $this->fechaenvio = $fechaenvio;
    
        return $this;
    }

    /**
     * Get fechaenvio
     *
     * @return \DateTime 
     */
    public function getFechaenvio()
    {
        return $this->fechaenvio;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Briefenviado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set usuario
     *
     * @param \Celmedia\PillsBundle\Entity\User $usuario
     * @return Briefenviado
     */
    public function setUsuario(\Celmedia\PillsBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Celmedia\PillsBundle\Entity\User 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set pillbrief
     *
     * @param \Celmedia\PillsBundle\Entity\Pillbrief $pillbrief
     * @return Briefenviado
     */
    public function setPillbrief(\Celmedia\PillsBundle\Entity\Pillbrief $pillbrief = null)
    {
        $this->pillbrief = $pillbrief;
    
        return $this;
    }

    /**
     * Get pillbrief
     *
     * @return \Celmedia\PillsBundle\Entity\Pillbrief 
     */
    public function getPillbrief()
    {
        return $this->pillbrief;
    }
}