<?php

namespace App\Animal\Model\Entity;

use App\Animal\Factory\CombBehavior;
use App\Animal\Factory\MealBehavior;
use App\Animal\Model\Attributes\DietOption;
use App\Animal\Model\Attributes\Name;
use App\Animal\Model\Behavior\CanCombTrait;

/**
 * Animal specific class
 *
 * @package App\Animal\Model\Entity
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class Tiger extends AnimalAbstract
{
    use CanCombTrait;

    public static function create(string $name): AnimalAbstract
    {
        $animal = new self(
            Name::fromString($name),
            DietOption::Carnivore
        );

        $animal->setEatBehavior(MealBehavior::getBehavior($animal));
        $animal->setCombBehavior(CombBehavior::getBehavior($animal));

        return $animal;
    }

    public function __toString(): string
    {
        return 'I am ' . (new \ReflectionClass($this))->getShortName() . ' ' . $this->name() . ' ' . '!';
    }
}