<?php

namespace FrontEnd\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task_State
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontEnd\FrontOfficeBundle\Entity\Task_StateRepository")
 */
class Task_State
{
    const TEST = 1;
    const TODO = 2;
    const DONE = 3;
    const CANCELLED = 4;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Task_State
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set name
     *
     * @param string $name
     *
     * @return Task_State
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
