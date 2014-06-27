<?php

namespace Celmedia\PillsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fondo
 */
class Fondo
{
    /**
     * @var integer
     */
    private $idfondo;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var string
     */
    private $color;


    /**
     * Get idfondo
     *
     * @return integer 
     */
    public function getIdfondo()
    {
        return $this->idfondo;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Fondo
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
     * Set color
     *
     * @param string $color
     * @return Fondo
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }
}