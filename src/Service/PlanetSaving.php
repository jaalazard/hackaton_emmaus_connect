<?php

namespace App\Service;

class PlanetSaving
{
    //Production d'un téléphone = 1000L d'eau.
    public function waterSavings(int $phonesSold): int
    {
        $waterSavings = $phonesSold *1000;
        return $waterSavings;
    }

    //Production d'un téléphone = 44 kilos de roche pour produire 130g de minerais et terres rares.
    public function mineralsSavings(int $phonesSold): int
    {
        $mineralsSavings = $phonesSold * 44;
        return $mineralsSavings;
    }
}
