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
    public const MODELCOUNT = [
        "iPhone X",
        "Galaxy S9",
        "Pixel 3",
        "P30 Pro",
        "Mi 9",
        "OnePlus 6T",
        "Xperia XZ2",
        "LG G7",
        "Mate 20 Pro",
        "Redmi Note 7",
        "Nokia 8.1",
        "Moto G7",
        "Xiaomi Mi A3",
        "Samsung A50",
        "Huawei P20 Lite",
        "iPhone XR",
        "Google Pixel 4",
        "OnePlus 7 Pro",
        "Sony Xperia 1",
        "LG V40 ThinQ",
        "Galaxy Note 10",
        "iPhone 11",
        "Xiaomi Redmi Note 8",
        "Huawei P30",
        "OnePlus 7T",
        "Sony Xperia XZ3",
        "Pixel 3a",
        "Samsung A70",
        "Nokia 9 PureView",
        "Mi Mix 3",
        "LG G8 ThinQ",
        "iPhone SE",
        "Samsung Fold",
        "OnePlus 8 Pro",
        "Xperia 5",
        "Google Pixel 4a",
        "Huawei Mate 30 Pro",
        "Moto G8 Plus",
        "Xiaomi Redmi Note 9",
        "Galaxy S20",
        "iPhone 12",
        "OnePlus Nord",
        "Pixel 4a 5G",
        "Samsung A51",
        "Xperia 1 II",
        "LG Velvet",
        "Huawei P40 Pro",
        "Mi 10 Pro",
        "Nokia 8.3",
        "OnePlus 8T",
        "Google Pixel 5",
        "Samsung Note 20",
        "iPhone 12 Pro",
        "Xiaomi Mi 10T",
        "Sony Xperia 5 II",
        "Moto G Power",
        "Galaxy S21",
        "Huawei Mate 40 Pro",
        "OnePlus 9",
        "Pixel 5a",
        "LG Wing",
        "Samsung A52",
        "iPhone 12 Mini",
        "Xiaomi Redmi Note 10",
        "Nokia 5.4",
        "Mi 11",
        "Google Pixel 6",
        "OnePlus 9 Pro",
        "Sony Xperia 1 III",
        "Samsung S21 Ultra",
        "Huawei P50 Pro",
        "Moto G Stylus",
        "Galaxy Fold 2",
        "iPhone 13",
        "Xiaomi Mi 11T",
        "OnePlus 9T",
        "Pixel 6 Pro",
        "LG Rollable",
        "Samsung Z Flip 3",
        "Mi Mix 4",
        "Nokia 8.4",
        "Sony Xperia 5 III",
        "Huawei Mate 50 Pro",
        "Moto G Pure",
        "Galaxy S22",
        "iPhone 14",
        "Xiaomi Redmi Note 11",
        "OnePlus 10",
        "Pixel 7",
        "LG Rainbow",
        "Samsung A73",
        "Huawei P60 Pro",
        "Mi 12",
        "Nokia 9.4",
        "Sony Xperia 1 IV",
    ];
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach(self::MODELCOUNT as $key => $models){
            $model = new Model();
            $model->setName($models);
            $model->setSerial($faker->word());
            $model->setColor($faker->colorName());
            $model->setRam($faker->numberBetween(4, 8));
            $model->setSize($faker->numberBetween(4, 9));
            $model->setWeight($faker->numberBetween(150, 800));
            $model->setConnection($faker->numberBetween(1, 5));
            $model->setMemory($faker->numberBetween(16, 512));

            $model->setMarque($this->getReference('brand_' . $faker->numberBetween(1, count(BrandFixtures::BRANCCOUNT) -1)));

            $this->addReference('model_' . $key, $model);

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
