<?php

namespace App\Animal\Factory;

use App\Animal\Api\AnimalInterface;
use App\Animal\Api\BehaviorServiceInterface;
use App\Animal\Api\CombBehaviorInterface;
use App\Animal\Model\Behavior\Actions\Comb;

/**
 * Behavior provider class.
 * In this case comb behavior is not depend on animal properties but this is a place to implement such a dependencies
 *
 * @package App\Animal\Factory
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class CombBehavior implements BehaviorServiceInterface
{
    public static function getBehavior(?AnimalInterface $animal): CombBehaviorInterface
    {
        return new Comb($animal);
    }
}