<?php

namespace FrontEnd\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task_Priority
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontEnd\FrontOfficeBundle\Entity\Task_PriorityRepository")
 */
class Task_Priority
{
    const HIGH = 1;
    const MEDIUM = 2;
    const LOW = 3;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @return Task_Priority
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
     * @return Task_Priority
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
