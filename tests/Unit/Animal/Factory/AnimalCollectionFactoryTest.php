<?php

declare(strict_types=1);

namespace Tests\Unit\Animal\Factory;

use App\Animal\Api\AnimalCollectionInterface;
use App\Animal\Factory\AnimalCollectionFactory;
use App\Animal\Model\Entity\AnimalCollection;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AnimalCollectionFactoryTest extends TestCase
{
    public function testCreatesAnimalCollectionFromInterface(): void
    {
        $collection = AnimalCollectionFactory::create(AnimalCollectionInterface::class);

        $this->assertInstanceOf(AnimalCollection::class, $collection);
        $this->assertInstanceOf(AnimalCollectionInterface::class, $collection);
    }

    public function testThrowsExceptionForUnknownInterface(): void
    {
        $this->expectException(InvalidArgumentException::class);

        AnimalCollectionFactory::create('Unknown\\Interface');
    }
}
