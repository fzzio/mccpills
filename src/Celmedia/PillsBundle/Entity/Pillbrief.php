<?php

namespace Celmedia\PillsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pillbrief
 */
class Pillbrief
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $idcontacto;

    /**
     * @var string
     */
    private $entendimiento;

    /**
     * @var string
     */
    private $briefing;

    /**
     * @var \DateTime
     */
    private $fechacreacion;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $calificaciones;

    /**
     * @var \Celmedia\PillsBundle\Entity\Pill
     */
    private $pill;

    /**
     * @var \Celmedia\PillsBundle\Entity\User
     */
    private $usuario;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $enviados;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->calificaciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enviados = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set idcontacto
     *
     * @param integer $idcontacto
     * @return Pillbrief
     */
    public function setIdcontacto($idcontacto)
    {
        $this->idcontacto = $idcontacto;
    
        return $this;
    }

    /**
     * Get idcontacto
     *
     * @return integer 
     */
    public function getIdcontacto()
    {
        return $this->idcontacto;
    }

    /**
     * Set entendimiento
     *
     * @param string $entendimiento
     * @return Pillbrief
     */
    public function setEntendimiento($entendimiento)
    {
        $this->entendimiento = $entendimiento;
    
        return $this;
    }

    /**
     * Get entendimiento
     *
     * @return string 
     */
    public function getEntendimiento()
    {
        return $this->entendimiento;
    }

    /**
     * Set briefing
     *
     * @param string $briefing
     * @return Pillbrief
     */
    public function setBriefing($briefing)
    {
        $this->briefing = $briefing;
    
        return $this;
    }

    /**
     * Get briefing
     *
     * @return string 
     */
    public function getBriefing()
    {
        return $this->briefing;
    }

    /**
     * Set fechacreacion
     *
     * @param \DateTime $fechacreacion
     * @return Pillbrief
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
     * @return Pillbrief
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
     * Add calificaciones
     *
     * @param \Celmedia\PillsBundle\Entity\Calificacion $calificaciones
     * @return Pillbrief
     */
    public function addCalificacione(\Celmedia\PillsBundle\Entity\Calificacion $calificaciones)
    {
        $this->calificaciones[] = $calificaciones;
    
        return $this;
    }

    /**
     * Remove calificaciones
     *
     * @param \Celmedia\PillsBundle\Entity\Calificacion $calificaciones
     */
    public function removeCalificacione(\Celmedia\PillsBundle\Entity\Calificacion $calificaciones)
    {
        $this->calificaciones->removeElement($calificaciones);
    }

    /**
     * Get calificaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCalificaciones()
    {
        return $this->calificaciones;
    }

    /**
     * Set pill
     *
     * @param \Celmedia\PillsBundle\Entity\Pill $pill
     * @return Pillbrief
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
     * Set usuario
     *
     * @param \Celmedia\PillsBundle\Entity\User $usuario
     * @return Pillbrief
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
     * Add enviados
     *
     * @param \Celmedia\PillsBundle\Entity\User $enviados
     * @return Pillbrief
     */
    public function addEnviado(\Celmedia\PillsBundle\Entity\User $enviados)
    {
        $this->enviados[] = $enviados;
    
        return $this;
    }

    /**
     * Remove enviados
     *
     * @param \Celmedia\PillsBundle\Entity\User $enviados
     */
    public function removeEnviado(\Celmedia\PillsBundle\Entity\User $enviados)
    {
        $this->enviados->removeElement($enviados);
    }

    /**
     * Get enviados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnviados()
    {
        return $this->enviados;
    }
}