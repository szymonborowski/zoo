<?php

declare(strict_types=1);

namespace App\Animal\Api;

/**
 * Interface for comb behavior classes.
 * This interface ensure that behavior inject to setBehavior method is same type as trait
 *
 * @package App\Animal\Api
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
interface CombBehaviorInterface extends BehaviorInterface
{
}