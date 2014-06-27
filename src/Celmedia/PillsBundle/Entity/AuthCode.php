<?php

namespace Celmedia\PillsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthCode
 */
class AuthCode
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Celmedia\PillsBundle\Entity\Client
     */
    private $client;

    /**
     * @var \Celmedia\PillsBundle\Entity\User
     */
    private $user;


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
     * Set client
     *
     * @param \Celmedia\PillsBundle\Entity\Client $client
     * @return AuthCode
     */
    public function setClient(\Celmedia\PillsBundle\Entity\Client $client = null)
    {
        $this->client = $client;
    
        return $this;
    }

    /**
     * Get client
     *
     * @return \Celmedia\PillsBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set user
     *
     * @param \Celmedia\PillsBundle\Entity\User $user
     * @return AuthCode
     */
    public function setUser(\Celmedia\PillsBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Celmedia\PillsBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
