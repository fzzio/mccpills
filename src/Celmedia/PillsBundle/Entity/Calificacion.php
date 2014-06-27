<?php

namespace Celmedia\PillsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calificacion
 */
class Calificacion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var integer
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Calificacion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    
        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Calificacion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Calificacion
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
     * @param integer $usuario
     * @return Calificacion
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return integer 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set pillbrief
     *
     * @param \Celmedia\PillsBundle\Entity\Pillbrief $pillbrief
     * @return Calificacion
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