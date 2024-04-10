<?php

declare(strict_types=1);

namespace App\Animal\Api;

/**
 * Interface for behavior class providers classes.
 * Behavior providers allows to dynamically inject into animal classes behaviors depends on animal property
 *
 * @package App\Animal\Api
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
interface BehaviorServiceInterface
{
    /**
     * Return behavior specific to a given animal
     *
     * @param AnimalInterface $animal
     * @return BehaviorInterface
     */
    public static function getBehavior(AnimalInterface $animal): BehaviorInterface;
}