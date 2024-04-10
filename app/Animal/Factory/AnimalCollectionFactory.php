<?php

declare(strict_types=1);

namespace App\Animal\Factory;

use InvalidArgumentException;

/**
 * Factory class for animal collection interface.
 *
 * @package App\Animal\Factory
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class AnimalCollectionFactory
{
    private static array $map = ['App\Animal\Api\AnimalCollectionInterface' => 'App\Animal\Model\Entity\AnimalCollection'];

    public static function create($instance, $data = [])
    {
        if (empty(self::$map[$instance])) {
            throw new InvalidArgumentException('There is no class defined for instance: ' . $instance);
        }

        return new self::$map[$instance]($data);
    }
}

