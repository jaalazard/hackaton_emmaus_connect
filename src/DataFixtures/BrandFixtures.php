<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture /* implements DependentFixtureInterface */
{
    public const BRANCCOUNT = 30;
    
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i=0; $i>self::BRANCCOUNT; $i++){
            $brand = new Brand();
            $brand->setName($faker->word());
            $this->addReference('brand_' . $i, $brand);

            $manager->persist($brand);
        }
        $manager->flush();
    }
   /*  public function getDependencies()
    {
        return [
            BrandFixtures::class,
        ];
    } */
}
