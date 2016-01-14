<?php

namespace FrontEnd\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Project
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontEnd\FrontOfficeBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    const SALT = "LaDateDuJourEstLe13/01/2016";
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $username;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstname;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastname;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        
    }
    
    public function getId()
    {
        return $this->id;    
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    public function getLastname()
    {
        return $this->lastname;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getRoles()
    {
        return array('ROLE_USER');
    }
    
    public function getSalt()
    {
        return self::SALT;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
}
