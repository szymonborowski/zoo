<?php

namespace App\Animal\Model\Entity;

use App\Animal\Factory\MealBehavior;
use App\Animal\Model\Attributes\DietOption;
use App\Animal\Model\Attributes\Name;

/**
 * Animal specific class
 *
 * @package App\Animal\Model\Entity
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class Elephant extends AnimalAbstract
{
    protected const string SPECIES = 'Elephant';

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