<?php

namespace Celmedia\PillsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pill
 */
class Pill
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var \DateTime
     */
    private $fechacreacion;

    /**
     * @var \Celmedia\PillsBundle\Entity\User
     */
    private $usuario;

    /**
     * @var \Celmedia\PillsBundle\Entity\Estudio
     */
    private $estudio;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tags;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categorias;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Pill
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
     * Set estado
     *
     * @param integer $estado
     * @return Pill
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
     * Set imagen
     *
     * @param string $imagen
     * @return Pill
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    
        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set fechacreacion
     *
     * @param \DateTime $fechacreacion
     * @return Pill
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
     * @param \Celmedia\PillsBundle\Entity\User $usuario
     * @return Pill
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
     * Set estudio
     *
     * @param \Celmedia\PillsBundle\Entity\Estudio $estudio
     * @return Pill
     */
    public function setEstudio(\Celmedia\PillsBundle\Entity\Estudio $estudio = null)
    {
        $this->estudio = $estudio;
    
        return $this;
    }

    /**
     * Get estudio
     *
     * @return \Celmedia\PillsBundle\Entity\Estudio 
     */
    public function getEstudio()
    {
        return $this->estudio;
    }

    /**
     * Add tags
     *
     * @param \Celmedia\PillsBundle\Entity\Tag $tags
     * @return Pill
     */
    public function addTag(\Celmedia\PillsBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    
        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Celmedia\PillsBundle\Entity\Tag $tags
     */
    public function removeTag(\Celmedia\PillsBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add categorias
     *
     * @param \Celmedia\PillsBundle\Entity\Categoria $categorias
     * @return Pill
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