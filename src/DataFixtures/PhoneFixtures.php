<?php

namespace App\DataFixtures;

use App\Entity\Phone;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PhoneFixtures extends Fixture implements DependentFixtureInterface
{
    public const PHONECOUNT = 100;
    public const CATEGORIES = ['Premium', 'Catégorie A', 'Catégorie B', 'Catégorie C', 'Hors catégorie'];
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i=0; $i<self::PHONECOUNT; $i++){
            $phone = new Phone();

            $phone->setIsBlocked($faker->boolean());

            $phone->setModel($this->getReference('model_' . $faker->numberBetween(1, 69)));
            $phone->setEtat($this->getReference('state_' . $faker->numberBetween(0, 3)));
            $phone->setUser($this->getReference('user_' . $faker->numberBetween(1, 10)));
            $phone->setCategory(self::CATEGORIES[array_rand(self::CATEGORIES)]);
            $phone->setPrice($faker->numberBetween(10, 1000));

            $this->addReference('phone_' . $i, $phone);

            $manager->persist($phone);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ModelFixtures::class,
            StateFixtures::class,
            UserFixtures::class,
        ];
    }
}
