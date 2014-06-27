<?php

namespace Celmedia\PillsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contacto
 */
class Contacto
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $usuario;

    /**
     * @var integer
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
     * Set usuario
     *
     * @param integer $usuario
     * @return Contacto
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
     * @param integer $pillbrief
     * @return Contacto
     */
    public function setPillbrief($pillbrief)
    {
        $this->pillbrief = $pillbrief;
    
        return $this;
    }

    /**
     * Get pillbrief
     *
     * @return integer 
     */
    public function getPillbrief()
    {
        return $this->pillbrief;
    }
}