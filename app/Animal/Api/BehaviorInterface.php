<?php

declare(strict_types=1);

namespace App\Animal\Api;

/**
 * Interface for anima behavior classes.
 * This interface is common for all animal behavior inject into classes by behaviors traits.
 *
 * @package App\Animal\Api
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
interface BehaviorInterface
{
    public function behave(): void;
}