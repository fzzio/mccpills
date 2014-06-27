<?php

namespace Celmedia\PillsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favorito
 */
class Favorito
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var \DateTime
     */
    private $fechacreacion;

    /**
     * @var \Celmedia\PillsBundle\Entity\UserPills
     */
    private $usuario;

    /**
     * @var \Celmedia\PillsBundle\Entity\Pill
     */
    private $pill;


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
     * Set estado
     *
     * @param integer $estado
     * @return Favorito
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
     * Set fechacreacion
     *
     * @param \DateTime $fechacreacion
     * @return Favorito
     */
    public function setFechacreacion($fechacreacion)
    {
        $this->fechacreacion = $fechacreacion;
    
        return $this;
    }

    /**
     * Get fechacreacion
     *
     * @return \DateTime 
     */
    public function getFechacreacion()
    {
        return $this->fechacreacion;
    }

    /**
     * Set usuario
     *
     * @param \Celmedia\PillsBundle\Entity\UserPills $usuario
     * @return Favorito
     */
    public function setUsuario(\Celmedia\PillsBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Celmedia\PillsBundle\Entity\UserPills 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set pill
     *
     * @param \Celmedia\PillsBundle\Entity\Pill $pill
     * @return Favorito
     */
    public function setPill(\Celmedia\PillsBundle\Entity\Pill $pill = null)
    {
        $this->pill = $pill;
    
        return $this;
    }

    /**
     * Get pill
     *
     * @return \Celmedia\PillsBundle\Entity\Pill 
     */
    public function getPill()
    {
        return $this->pill;
    }
}