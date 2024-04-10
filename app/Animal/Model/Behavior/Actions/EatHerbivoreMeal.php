<?php

namespace App\Animal\Model\Behavior\Actions;

use App\Animal\Api\EatBehaviorInterface;
use ReflectionClass;

/**
 * This class provide eat behavior for herbivores
 *
 * @package App\Animal\Model\Behavior
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class EatHerbivoreMeal extends BehaviorAbstract implements EatBehaviorInterface
{
    public function behave(): void
    {
        if (!$this->animal) {
            return;
        }

        echo (new ReflectionClass($this->animal))->getShortName() . ' ' . $this->animal->name() . ' ';
        echo "I'm eating vegetables!\n";
    }
}