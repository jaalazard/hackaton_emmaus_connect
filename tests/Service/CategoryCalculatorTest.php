<?php

use App\Service\CategoryCalculator;
use PHPUnit\Framework\TestCase;

class CategoryCalculatorTest extends TestCase
{
    public function testCategoryCalculator(): void
    {
        $ram = 6;
        $memory = 256;
        $isBlocked = false;
        $state = 'TBE';
        $categoryCalculator = new CategoryCalculator();
        $this->assertEquals('Catégorie B', $categoryCalculator->categoryCalculator($ram, $memory, $isBlocked, $state));

        $ram = 0;
        $memory = 256;
        $isBlocked = false;
        $state = 'TBE';
        $categoryCalculator = new CategoryCalculator();
        $this->assertEquals('RAM insuffisante pour mise en vente', $categoryCalculator->categoryCalculator($ram, $memory, $isBlocked, $state));

        $ram = 6;
        $memory = 0;
        $isBlocked = false;
        $state = 'TBE';
        $categoryCalculator = new CategoryCalculator();
        $this->assertEquals('Mémoire insuffisante pour mise en vente', $categoryCalculator->categoryCalculator($ram, $memory, $isBlocked, $state));

        $ram = 2;
        $memory = 16;
        $isBlocked = true;
        $state = 'bon';
        $categoryCalculator = new CategoryCalculator();
        $this->assertEquals('Catégorie C', $categoryCalculator->categoryCalculator($ram, $memory, $isBlocked, $state));

        $ram = 6;
        $memory = 256;
        $isBlocked = false;
        $state = 'DEEE';
        $categoryCalculator = new CategoryCalculator();
        $this->assertEquals('Etat insuffisant pour mise en vente!!', $categoryCalculator->categoryCalculator($ram, $memory, $isBlocked, $state));
    }
}
