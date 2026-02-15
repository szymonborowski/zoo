<?php

declare(strict_types=1);

namespace Tests\Unit\Animal\Entity;

use App\Animal\Api\AnimalCollectionInterface;
use App\Animal\Api\AnimalRepositoryInterface;
use App\Animal\Factory\AnimalCollectionFactory;
use App\Animal\Model\Attributes\DietOption;
use App\Animal\Model\Attributes\Name;
use App\Animal\Model\Entity\AnimalRepository;
use App\Animal\Model\Entity\Elephant;
use App\Animal\Model\Entity\Fox;
use App\Animal\Model\Entity\Rabbit;
use App\Animal\Model\Entity\Rhinoceros;
use App\Animal\Model\Entity\SnowLeopard;
use App\Animal\Model\Entity\Tiger;
use PHPUnit\Framework\TestCase;

class AnimalRepositoryTest extends TestCase
{
    private AnimalRepository $repository;
    private AnimalCollectionInterface $collection;

    protected function setUp(): void
    {
        $this->repository = new AnimalRepository();
        $this->collection = AnimalCollectionFactory::create(AnimalCollectionInterface::class);
        $this->collection->addData([
            Tiger::create('Wojtek'),
            Elephant::create('Maksim'),
            Fox::create('Maryś'),
            Rabbit::create('Renia'),
            Rhinoceros::create('Bartek'),
            SnowLeopard::create('Zuzia'),
        ]);
    }

    public function testImplementsAnimalRepositoryInterface(): void
    {
        $this->assertInstanceOf(AnimalRepositoryInterface::class, $this->repository);
    }

    // --- filterByDiet ---

    public function testFilterByCarnivoreReturnsOnlyCarnivores(): void
    {
        $result = $this->repository->filterByDiet($this->collection, DietOption::Carnivore);

        $this->assertCount(2, $result);
        foreach ($result as $animal) {
            $this->assertSame(DietOption::Carnivore, $animal->diet());
        }
    }

    public function testFilterByHerbivoreReturnsOnlyHerbivores(): void
    {
        $result = $this->repository->filterByDiet($this->collection, DietOption::Herbivore);

        $this->assertCount(3, $result);
        foreach ($result as $animal) {
            $this->assertSame(DietOption::Herbivore, $animal->diet());
        }
    }

    public function testFilterByOmnivoreReturnsOnlyOmnivores(): void
    {
        $result = $this->repository->filterByDiet($this->collection, DietOption::Omnivore);

        $this->assertCount(1, $result);
        foreach ($result as $animal) {
            $this->assertSame(DietOption::Omnivore, $animal->diet());
        }
    }

    public function testFilterByDietReturnsAnimalCollectionInterface(): void
    {
        $result = $this->repository->filterByDiet($this->collection, DietOption::Carnivore);

        $this->assertInstanceOf(AnimalCollectionInterface::class, $result);
    }

    public function testFilterByDietReturnsEmptyCollectionWhenNoMatch(): void
    {
        $collection = AnimalCollectionFactory::create(AnimalCollectionInterface::class);
        $collection[] = Tiger::create('Wojtek');

        $result = $this->repository->filterByDiet($collection, DietOption::Herbivore);

        $this->assertCount(0, $result);
    }

    // --- filterByName ---

    public function testFilterByNameReturnsMatchingAnimal(): void
    {
        $result = $this->repository->filterByName($this->collection, Name::fromString('Wojtek'));

        $this->assertCount(1, $result);
        $this->assertSame('Wojtek', (string) $result[0]->name());
    }

    public function testFilterByNameReturnsEmptyCollectionWhenNoMatch(): void
    {
        $result = $this->repository->filterByName($this->collection, Name::fromString('Nieznany'));

        $this->assertCount(0, $result);
    }

    public function testFilterByNameReturnsAnimalCollectionInterface(): void
    {
        $result = $this->repository->filterByName($this->collection, Name::fromString('Wojtek'));

        $this->assertInstanceOf(AnimalCollectionInterface::class, $result);
    }

    public function testFilterByNameIsCaseSensitive(): void
    {
        $result = $this->repository->filterByName($this->collection, Name::fromString('wojtek'));

        $this->assertCount(0, $result);
    }

    // --- filterByCanComb ---

    public function testFilterByCanCombReturnsOnlyAnimalsWithFur(): void
    {
        $result = $this->repository->filterByCanComb($this->collection);

        // Tiger, Fox, Rabbit, SnowLeopard have CanCombTrait; Elephant, Rhinoceros don't
        $this->assertCount(4, $result);
    }

    public function testFilterByCanCombExcludesAnimalsWithoutFur(): void
    {
        $collection = AnimalCollectionFactory::create(AnimalCollectionInterface::class);
        $collection->addData([
            Elephant::create('Maksim'),
            Rhinoceros::create('Bartek'),
        ]);

        $result = $this->repository->filterByCanComb($collection);

        $this->assertCount(0, $result);
    }

    public function testFilterByCanCombReturnsAnimalCollectionInterface(): void
    {
        $result = $this->repository->filterByCanComb($this->collection);

        $this->assertInstanceOf(AnimalCollectionInterface::class, $result);
    }
}
