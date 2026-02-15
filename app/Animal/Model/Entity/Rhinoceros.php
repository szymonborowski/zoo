<?php

namespace App\Animal\Model\Entity;

use App\Animal\Factory\MealBehavior;
use App\Animal\Model\Attributes\DietOption;
use App\Animal\Model\Attributes\Name;
use App\Animal\Model\Attributes\Diet;

/**
 * Animal specific class
 *
 * @package App\Animal\Model\Entity
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class Rhinoceros extends AnimalAbstract
{
    protected const string SPECIES = 'Rhinoceros';

    public static function create(string $name): AnimalAbstract
    {
        $animal = new self(
            Name::fromString($name),
            DietOption::Herbivore
        );

        $animal->setEatBehavior(MealBehavior::getBehavior($animal));

        return $animal;
    }
}