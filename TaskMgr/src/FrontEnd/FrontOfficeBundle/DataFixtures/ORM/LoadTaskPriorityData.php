<?php

// src/FrontEnd/FrontOfficeBundle/DataFixtures/ORM/LoadTaskStateData.php

namespace Acme\HelloBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FrontEnd\FrontOfficeBundle\Entity\Task_Priority;

class LoadTaskPriorityData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $prio1 = new Task_Priority();
        $prio1->setId(1);
        $prio1->setName("HAUTE");
        
        $prio2 = new Task_Priority();
        $prio2->setId(2);
        $prio2->setName("MOYENNE");
        
        $prio3 = new Task_Priority();
        $prio3->setId(3);
        $prio3->setName("FAIBLE");

        $manager->persist($prio1);
        $manager->persist($prio2);
        $manager->persist($prio3);
        $manager->flush();
    }
}