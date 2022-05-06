<?php

namespace App\DataFixtures;

use App\Entity\Test;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TestFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i <= 100; $i++) {
            $test = new Test();
            $test->setName($i);
            $manager->persist($test);
        }
        $manager->flush();
    }
}
