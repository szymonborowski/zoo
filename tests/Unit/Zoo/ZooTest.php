<?php

declare(strict_types=1);

namespace Tests\Unit\Zoo;

use App\Animal\Api\AnimalCollectionInterface;
use App\Animal\Api\AnimalInterface;
use App\Animal\Api\AnimalRepositoryInterface;
use App\Animal\Factory\AnimalCollectionFactory;
use App\Animal\Factory\AnimalRepositoryFactory;
use App\Animal\Model\Entity\Elephant;
use App\Animal\Model\Entity\Fox;
use App\Animal\Model\Entity\Rabbit;
use App\Animal\Model\Entity\Rhinoceros;
use App\Animal\Model\Entity\SnowLeopard;
use App\Animal\Model\Entity\Tiger;
use App\Zoo\Api\ZooInterface;
use App\Zoo\Model\Entity\Zoo;
use PHPUnit\Framework\TestCase;

class ZooTest extends TestCase
{
    private Zoo $zoo;

    protected function setUp(): void
    {
        $collection = AnimalCollectionFactory::create(AnimalCollectionInterface::class);
        $repository = AnimalRepositoryFactory::create(AnimalRepositoryInterface::class);

        $this->zoo = new Zoo($collection, $repository);

        $this->zoo->getAnimalCollection()->addData([
            Elephant::create('Maksim'),
            Fox::create('Maryś'),
            Rabbit::create('Renia'),
            Rhinoceros::create('Bartek'),
            SnowLeopard::create('Zuzia'),
            Tiger::create('Wojtek'),
        ]);
    }

    public function testImplementsZooInterface(): void
    {
        $this->assertInstanceOf(ZooInterface::class, $this->zoo);
    }

    public function testGetAnimalCollectionReturnsAllAnimals(): void
    {
        $collection = $this->zoo->getAnimalCollection();

        $this->assertInstanceOf(AnimalCollectionInterface::class, $collection);
        $this->assertCount(6, $collection);
    }

    // --- feedAllAnimalsInZoo ---

    public function testFeedAllAnimalsInZooOutputsAllMeals(): void
    {
        $this->expectOutputString(
            "Elephant Maksim I'm eating vegetables!\n" .
            "Fox Maryś I'm eating vegetables and meat!\n" .
            "Rabbit Renia I'm eating vegetables!\n" .
            "Rhinoceros Bartek I'm eating vegetables!\n" .
            "SnowLeopard Zuzia I'm eating meat!\n" .
            "Tiger Wojtek I'm eating meat!\n"
        );

        $this->zoo->feedAllAnimalsInZoo();
    }

    // --- combAllAnimals ---

    public function testCombAllAnimalsOutputsOnlyFurryAnimals(): void
    {
        $this->expectOutputString(
            "Fox Maryś Humans combing me!\n" .
            "Rabbit Renia Humans combing me!\n" .
            "SnowLeopard Zuzia Humans combing me!\n" .
            "Tiger Wojtek Humans combing me!\n"
        );

        $this->zoo->combAllAnimals();
    }

    // --- listOfCarnivores ---

    public function testListOfCarnivoresReturnsCorrectAnimals(): void
    {
        $carnivores = $this->zoo->listOfCarnivores();

        $this->assertCount(2, $carnivores);

        $names = [];
        foreach ($carnivores as $animal) {
            $names[] = (string) $animal->name();
        }
        $this->assertContains('Zuzia', $names);
        $this->assertContains('Wojtek', $names);
    }

    // --- listOfHerbivores ---

    public function testListOfHerbivoresReturnsCorrectAnimals(): void
    {
        $herbivores = $this->zoo->listOfHerbivores();

        $this->assertCount(3, $herbivores);

        $names = [];
        foreach ($herbivores as $animal) {
            $names[] = (string) $animal->name();
        }
        $this->assertContains('Maksim', $names);
        $this->assertContains('Renia', $names);
        $this->assertContains('Bartek', $names);
    }

    // --- listOfOmnivores ---

    public function testListOfOmnivoresReturnsCorrectAnimals(): void
    {
        $omnivores = $this->zoo->listOfOmnivores();

        $this->assertCount(1, $omnivores);
        $this->assertSame('Maryś', (string) $omnivores[0]->name());
    }

    // --- getAnimalByName ---

    public function testGetAnimalByNameReturnsCorrectAnimal(): void
    {
        $animal = $this->zoo->getAnimalByName('Wojtek');

        $this->assertInstanceOf(AnimalInterface::class, $animal);
        $this->assertSame('Wojtek', (string) $animal->name());
    }

    public function testGetAnimalByNameReturnsNullForUnknownName(): void
    {
        $animal = $this->zoo->getAnimalByName('Nieznany');

        $this->assertNull($animal);
    }

    // --- empty zoo ---

    public function testEmptyZooFeedDoesNothing(): void
    {
        $emptyZoo = new Zoo(
            AnimalCollectionFactory::create(AnimalCollectionInterface::class),
            AnimalRepositoryFactory::create(AnimalRepositoryInterface::class),
        );

        $this->expectOutputString('');

        $emptyZoo->feedAllAnimalsInZoo();
    }

    public function testEmptyZooCombDoesNothing(): void
    {
        $emptyZoo = new Zoo(
            AnimalCollectionFactory::create(AnimalCollectionInterface::class),
            AnimalRepositoryFactory::create(AnimalRepositoryInterface::class),
        );

        $this->expectOutputString('');

        $emptyZoo->combAllAnimals();
    }

    public function testEmptyZooGetAnimalByNameReturnsNull(): void
    {
        $emptyZoo = new Zoo(
            AnimalCollectionFactory::create(AnimalCollectionInterface::class),
            AnimalRepositoryFactory::create(AnimalRepositoryInterface::class),
        );

        $this->assertNull($emptyZoo->getAnimalByName('Wojtek'));
    }

    public function testEmptyZooListsReturnEmptyCollections(): void
    {
        $emptyZoo = new Zoo(
            AnimalCollectionFactory::create(AnimalCollectionInterface::class),
            AnimalRepositoryFactory::create(AnimalRepositoryInterface::class),
        );

        $this->assertCount(0, $emptyZoo->listOfCarnivores());
        $this->assertCount(0, $emptyZoo->listOfHerbivores());
        $this->assertCount(0, $emptyZoo->listOfOmnivores());
    }
}
