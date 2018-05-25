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
        $state1->setName("2. TEST");
        
        $state2 = new Task_State();
        $state2->setId(2);
        $state2->setName("3. TODO");

        $state2 = new Task_State();
        $state2->setId(3);
        $state2->setName("1. IN PROGRESS");
        
        $state3 = new Task_State();
        $state3->setId(4);
        $state3->setName("4. DONE");
        
        $state4 = new Task_State();
        $state4->setId(5);
        $state4->setName("5. CANCELLED");

        $manager->persist($state1);
        $manager->persist($state2);
        $manager->persist($state3);
        $manager->persist($state4);
        $manager->flush();
    }
}