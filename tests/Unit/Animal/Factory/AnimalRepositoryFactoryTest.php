<?php

declare(strict_types=1);

namespace Tests\Unit\Animal\Factory;

use App\Animal\Api\AnimalRepositoryInterface;
use App\Animal\Factory\AnimalRepositoryFactory;
use App\Animal\Model\Entity\AnimalRepository;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AnimalRepositoryFactoryTest extends TestCase
{
    public function testCreatesAnimalRepositoryFromInterface(): void
    {
        $repository = AnimalRepositoryFactory::create(AnimalRepositoryInterface::class);

        $this->assertInstanceOf(AnimalRepository::class, $repository);
        $this->assertInstanceOf(AnimalRepositoryInterface::class, $repository);
    }

    public function testThrowsExceptionForUnknownInterface(): void
    {
        $this->expectException(InvalidArgumentException::class);

        AnimalRepositoryFactory::create('Unknown\\Interface');
    }
}
