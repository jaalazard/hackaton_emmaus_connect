<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public const BRANCCOUNT = [
        "Apple",
        "Samsung",
        "Google",
        "Huawei",
        "Xiaomi",
        "Sony",
        "LG",
        "Motorola",
        "Nokia",
        "OnePlus",
        "HTC",
        "Lenovo",
        "ASUS",
        "BlackBerry",
        "OPPO",
        "Vivo",
        "Realme",
        "ZTE",
        "Alcatel",
        "Honor",
        "Meizu",
        "TCL",
        "Infinix",
        "Panasonic",
        "LeEco",
        "Gionee",
        "Micromax",
        "BLU",
        "Yota",
        "Essential",
        "Sharp",
        "Amazon",
        "Razer",
        "Fairphone",
        "ZUK",
        "CAT",
        "Energizer",
        "Palm",
        "Wiko",
        "Acer",
        "Microsoft",
        "Doro",
        "Vertu",
        "Maxon",
        "NEC",
        "Prestigio",
        "QMobile",
        "Siemens",
        "Sonim",
        "Toshiba",
        "Unnecto",
        "Xolo",
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::BRANCCOUNT as $key => $brands) {
            $brand = new Brand();
            $brand->setName($brands);
            $this->addReference('brand_' . $key, $brand);

            $manager->persist($brand);
        }
        $manager->flush();
    }
}
