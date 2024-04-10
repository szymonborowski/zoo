<?php

namespace App\Animal\Model\Behavior;

use App\Animal\Api\CombBehaviorInterface;

/**
 * Behavior trait that allows to inject to class comb functionality.
 * If animal has fur trait can be used in anima specific class and populate with behavior with CombBehavior provider
 *
 * @package App\Animal\Model\Behavior
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
trait CanCombTrait
{
    private CombBehaviorInterface $behavior;

    public function setCombBehavior(CombBehaviorInterface $behavior): void
    {
        $this->behavior = $behavior;
    }

    public function comb(): void
    {
        $this->behavior->behave();
    }
}