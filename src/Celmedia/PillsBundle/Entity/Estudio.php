<?php

namespace Celmedia\PillsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estudio
 */
class Estudio
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categorias;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categorias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set nombre
     *
     * @param string $nombre
     * @return Estudio
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Estudio
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Estudio
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
     * Set estado
     *
     * @param integer $estado
     * @return Estudio
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
     * Add categorias
     *
     * @param \Celmedia\PillsBundle\Entity\Categoria $categorias
     * @return Estudio
     */
    public function addCategoria(\Celmedia\PillsBundle\Entity\Categoria $categorias)
    {
        $this->categorias[] = $categorias;
    
        return $this;
    }

    /**
     * Remove categorias
     *
     * @param \Celmedia\PillsBundle\Entity\Categoria $categorias
     */
    public function removeCategoria(\Celmedia\PillsBundle\Entity\Categoria $categorias)
    {
        $this->categorias->removeElement($categorias);
    }

    /**
     * Get categorias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategorias()
    {
        return $this->categorias;
    }
   
}