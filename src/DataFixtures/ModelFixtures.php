<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Model;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModelFixtures extends Fixture implements DependentFixtureInterface
{
    public const MODELCOUNT = 70;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i=0; $i<self::MODELCOUNT; $i++){
            $model = new Model();
            $model->setName($faker->word());
            $model->setSerial($faker->word());
            $model->setColor($faker->colorName());
            $model->setRam($faker->numberBetween(4, 8));
            $model->setSize($faker->numberBetween(4, 9));
            $model->setWeight($faker->numberBetween(150, 800));
            $model->setConnection($faker->numberBetween(1, 5));
            $model->setMemory($faker->numberBetween(16, 512));

            $model->setMarque($this->getReference('brand_' . $faker->numberBetween(1, BrandFixtures::BRANCCOUNT -1)));

            $this->addReference('model_' . $i, $model);

            $manager->persist($model);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            BrandFixtures::class,
        ];
    }
}
