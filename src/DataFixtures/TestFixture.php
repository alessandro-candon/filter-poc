<?php

namespace App\DataFixtures;

use App\Entity\Relationship;
use App\Entity\Test;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TestFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rs = [];
        for ($x = 0; $x <= 110; $x++) {
            $r = new Relationship();
            $r->setName($x);
            $manager->persist($r);
            $rs[] = $r;
        }
        for ($i = 0; $i <= 100; $i++) {
            $test = new Test();
            $test->setName($i)
                ->addRelationship($rs[$i+1]);
            $manager->persist($test);
        }
        $manager->flush();
    }
}
