<?php

namespace App\Service;

use Exception;
use App\Entity\State;

use function PHPUnit\Framework\throwException;

class Calculator
{
    public function CategoryCalculator(int $ram, string $memory, bool $isBlocked, State $state)
    {
        //Initialisation des points
        $points = 0;

        //Calcul des points en fonction de la RAM
        if ($ram === 2) {
            $points += 40;
        } elseif ($ram === 3) {
            $points += 54;
        } elseif ($ram === 4 || $ram === 5) {
            $points += 70;
        } elseif ($ram >= 6) {
            $points += 85;
        } else{
            throw new Exception('RAM insuffisante pour une mise en vente');
        }
        //Calcul des points en fonction de la capacité de stockage
        if ($memory === 16) {
            $points += 31;
        } elseif ($memory === 32) {
            $points += 45;
        } elseif ($memory === 64) {
            $points += 66;
        } elseif ($memory >= 128) {
            $points += 95;
        } else {
            throw new Exception('Mémoire insuffisante pour une mise en vente');
         }
        //Pondération en fonction du blocage
        if ($isBlocked === true) {
            $points -= 0.1 * $points;
        }
        //pondération en fonction de l'état
        if($state->getName() === 'mauvais'){
            throw new Exception('Etat insuffisant pour une mise en vente !');
        }
        elseif($state->getName() === "bon"){
            $points += 0.05 * $points;
        }
        elseif($state->getName() === "TBE"){
            $points += 0.1 * $points;
        }
        //Détermination de la catégorie en fonction des points
        if($points >= 41 && $points < 116){
            return 'Catégorie C';
        }
        elseif($points >= 116 && $points < 206){
            return 'Catégorie B';
        }
        elseif($points >= 206 && $points < 326){
            return 'Catégorie A';
        }
        elseif($points >= 326){
            return 'Premium';
        }
        else{
            return 'Hors catégorie';
        }
    }

    public function PriceCalculator(int $ram, string $memory, bool $isBlocked, State $state)
    {
        //Initialisation des points
        $points = 0;

        //Calcul des points en fonction de la RAM
        if ($ram === 2) {
            $points += 40;
        } elseif ($ram === 3) {
            $points += 54;
        } elseif ($ram === 4 || $ram === 5) {
            $points += 70;
        } elseif ($ram >= 6) {
            $points += 85;
        }
        //Calcul des points en fonction de la capacité de stockage
        if ($memory === 16) {
            $points += 31;
        } elseif ($memory === 32) {
            $points += 45;
        } elseif ($memory === 64) {
            $points += 66;
        } elseif ($memory >= 128) {
            $points += 95;
        }
        //Pondération en fonction du blocage
        if ($isBlocked === true) {
            $points -= 0.1 * $points;
        }
        //pondération en fonction de l'état
        if($state->getName() === "bon"){
            $points += 0.05 * $points;
        }
        elseif($state->getName() === "TBE"){
            $points += 0.1 * $points;
        }
        
        //Détermination du prix en fonction des points
        return $points;
    }
}
