<?php

// src/FrontEnd/FrontOfficeBundle/DataFixtures/ORM/LoadTaskStateData.php

namespace Acme\HelloBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FrontEnd\FrontOfficeBundle\Entity\Task_State;

class LoadTaskStateData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $state1 = new Task_State();
        $state1->setId(1);
        $state1->setName("TEST");
        
        $state2 = new Task_State();
        $state2->setId(2);
        $state2->setName("TODO");
        
        $state3 = new Task_State();
        $state3->setId(3);
        $state3->setName("DONE");
        
        $state4 = new Task_State();
        $state4->setId(4);
        $state4->setName("CANCELLED");

        $manager->persist($state1);
        $manager->persist($state2);
        $manager->persist($state3);
        $manager->persist($state4);
        $manager->flush();
    }
}