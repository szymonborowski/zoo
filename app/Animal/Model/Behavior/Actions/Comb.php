<?php

namespace App\Animal\Model\Behavior\Actions;

use App\Animal\Api\CombBehaviorInterface;
use ReflectionClass;

/**
 * This class provide default behavior for comb
 *
 * @package App\Animal\Model\Behavior
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class Comb extends BehaviorAbstract implements CombBehaviorInterface
{
    public function behave(): void
    {
        if (!$this->animal) {
            return;
        }

        echo (new ReflectionClass($this->animal))->getShortName() . ' ' . $this->animal->name() . ' ';
        echo "Humans combing me!\n";
    }
}