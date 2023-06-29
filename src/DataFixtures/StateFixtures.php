<?php

namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class StateFixtures extends Fixture
{
    public const STATEFIXTURE = [
        'HS', 'mauvais', 'bon', 'TBE',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach(self::STATEFIXTURE as $key => $stateRow){
            $state = new State();
            $state->setName($stateRow);
            $this->addReference('state_' . $key, $state);

            $manager->persist($state);
        }

        $manager->flush();
    }
}
