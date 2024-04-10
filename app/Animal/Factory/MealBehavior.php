<?php

namespace App\Animal\Factory;

use App\Animal\Api\AnimalInterface;
use App\Animal\Api\BehaviorServiceInterface;
use App\Animal\Api\EatBehaviorInterface;
use App\Animal\Model\Attributes\DietOption;
use App\Animal\Model\Behavior\Actions\EatCarnivoreMeal;
use App\Animal\Model\Behavior\Actions\EatHerbivoreMeal;
use App\Animal\Model\Behavior\Actions\EatOmnivoreMeal;

/**
 * Behavior provider class.
 * Eat animal behavior depends on animal diet type so there are several meal behavior classes
 * that can be provided to animal.
 *
 * @package App\Animal\Factory
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class MealBehavior implements BehaviorServiceInterface
{
    public static function getBehavior(?AnimalInterface $animal): EatBehaviorInterface
    {
        return match ($animal->diet()) {
            DietOption::Omnivore => new EatOmnivoreMeal($animal),
            DietOption::Carnivore => new EatCarnivoreMeal($animal),
            default => new EatHerbivoreMeal($animal),
        };
    }
}