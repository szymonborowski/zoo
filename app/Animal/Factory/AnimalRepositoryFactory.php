<?php

declare(strict_types=1);

namespace App\Animal\Factory;

use InvalidArgumentException;

/**
 * Factory class for animal repository interface.
 *
 * @package App\Animal\Factory
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class AnimalRepositoryFactory
{
    private static array $map = ['App\Animal\Api\AnimalRepositoryInterface' => 'App\Animal\Model\Entity\AnimalRepository'];

    public static function create($instance, $data = [])
    {
        if (empty(static::$map[$instance])) {
            throw new InvalidArgumentException('There is no class defined for instance: ' . $instance);
        }

        return new static::$map[$instance]($data);
    }
}