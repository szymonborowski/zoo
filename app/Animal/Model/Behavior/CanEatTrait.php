<?php

namespace App\Animal\Model\Behavior;

use App\Animal\Api\AnimalInterface;
use App\Animal\Api\EatBehaviorInterface;

/**
 * Behavior trait that allows to inject to class eat functionality.
 * All animals have this behavior so this trait is in use in AnimalAbstract class
 *
 * @package App\Animal\Model\Behavior
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
trait CanEatTrait
{
    private EatBehaviorInterface $behavior;

    public function setEatBehavior(EatBehaviorInterface $behavior): void
    {
        $this->behavior = $behavior;
    }

    public function eat(): void
    {
        $this->behavior->behave();
    }
}