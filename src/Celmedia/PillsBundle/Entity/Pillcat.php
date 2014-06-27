<?php

namespace Celmedia\PillsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pillcat
 */
class Pillcat
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
     * @var \Celmedia\PillsBundle\Entity\Pill
     */
    private $pill;

    /**
     * @var \Celmedia\PillsBundle\Entity\Categoria
     */
    private $categoria;


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
     * @return Pillcat
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
     * Set pill
     *
     * @param \Celmedia\PillsBundle\Entity\Pill $pill
     * @return Pillcat
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

    /**
     * Set categoria
     *
     * @param \Celmedia\PillsBundle\Entity\Categoria $categoria
     * @return Pillcat
     */
    public function setCategoria(\Celmedia\PillsBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Celmedia\PillsBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
}