<?php

namespace Celmedia\PillsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pilltag
 */
class Pilltag
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fechacreacion;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var \Celmedia\PillsBundle\Entity\Tag
     */
    private $tag;

    /**
     * @var \Celmedia\PillsBundle\Entity\Pill
     */
    private $pilll;


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
     * Set fechacreacion
     *
     * @param \DateTime $fechacreacion
     * @return Pilltag
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
     * Set estado
     *
     * @param integer $estado
     * @return Pilltag
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
     * Set tag
     *
     * @param \Celmedia\PillsBundle\Entity\Tag $tag
     * @return Pilltag
     */
    public function setTag(\Celmedia\PillsBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;
    
        return $this;
    }

    /**
     * Get tag
     *
     * @return \Celmedia\PillsBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set pilll
     *
     * @param \Celmedia\PillsBundle\Entity\Pill $pilll
     * @return Pilltag
     */
    public function setPilll(\Celmedia\PillsBundle\Entity\Pill $pilll = null)
    {
        $this->pilll = $pilll;
    
        return $this;
    }

    /**
     * Get pilll
     *
     * @return \Celmedia\PillsBundle\Entity\Pill 
     */
    public function getPilll()
    {
        return $this->pilll;
    }
}