<?php

namespace Celmedia\PillsBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * UserPills
 */
class User  extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;
 
   
       public function __construct()
    {
        parent::__construct();
        // your own logic
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
}