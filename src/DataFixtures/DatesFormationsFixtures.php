<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\DatesFormations;

class DatesFormationsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 5; $i++){
          $stage_a1 = new DatesFormations();
          $stage_a1->setDate("2 et 3 mars 2019 en WE à Toulouse (Monique Ducarre et Elizabeth Guillebaud)");

          $manager->persist($stage_a1);
        }


        $manager->flush();
    }
}
