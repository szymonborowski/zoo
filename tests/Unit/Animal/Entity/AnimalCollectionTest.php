<?php

declare(strict_types=1);

namespace Tests\Unit\Animal\Entity;

use App\Animal\Api\AnimalCollectionInterface;
use App\Animal\Model\Entity\AnimalCollection;
use App\Animal\Model\Entity\Tiger;
use App\Animal\Model\Entity\Elephant;
use App\Animal\Model\Entity\Fox;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AnimalCollectionTest extends TestCase
{
    private AnimalCollection $collection;

    protected function setUp(): void
    {
        $this->collection = new AnimalCollection();
    }

    public function testImplementsAnimalCollectionInterface(): void
    {
        $this->assertInstanceOf(AnimalCollectionInterface::class, $this->collection);
    }

    public function testEmptyCollectionHasCountZero(): void
    {
        $this->assertCount(0, $this->collection);
    }

    public function testAddSingleAnimal(): void
    {
        $tiger = Tiger::create('Wojtek');
        $this->collection[] = $tiger;

        $this->assertCount(1, $this->collection);
    }

    public function testAddMultipleAnimals(): void
    {
        $this->collection->addData([
            Tiger::create('Wojtek'),
            Elephant::create('Maksim'),
            Fox::create('Maryś'),
        ]);

        $this->assertCount(3, $this->collection);
    }

    public function testRejectsDuplicateAnimalOfSameTypeAndName(): void
    {
        $this->collection[] = Tiger::create('Wojtek');

        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = Tiger::create('Wojtek');
    }

    public function testAllowsSameNameDifferentSpecies(): void
    {
        $this->collection->addData([
            Tiger::create('Wojtek'),
            Elephant::create('Wojtek'),
        ]);

        $this->assertCount(2, $this->collection);
    }

    public function testAllowsSameSpeciesDifferentNames(): void
    {
        $this->collection->addData([
            Tiger::create('Wojtek'),
            Tiger::create('Ania'),
        ]);

        $this->assertCount(2, $this->collection);
    }

    public function testOffsetGetReturnsAnimal(): void
    {
        $tiger = Tiger::create('Wojtek');
        $this->collection[] = $tiger;

        $this->assertSame($tiger, $this->collection[0]);
    }

    public function testOffsetGetReturnsNullForMissingOffset(): void
    {
        $this->assertNull($this->collection[0]);
    }

    public function testOffsetExistsReturnsTrueForExistingOffset(): void
    {
        $this->collection[] = Tiger::create('Wojtek');

        $this->assertTrue(isset($this->collection[0]));
    }

    public function testOffsetExistsReturnsFalseForMissingOffset(): void
    {
        $this->assertFalse(isset($this->collection[0]));
    }

    public function testOffsetUnsetRemovesAnimal(): void
    {
        $this->collection[] = Tiger::create('Wojtek');
        unset($this->collection[0]);

        $this->assertFalse(isset($this->collection[0]));
    }

    public function testOffsetSetWithExplicitKey(): void
    {
        $tiger = Tiger::create('Wojtek');
        $this->collection[5] = $tiger;

        $this->assertSame($tiger, $this->collection[5]);
    }

    public function testRejectsNonAnimalValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = 'not an animal';
    }

    public function testIterateOverCollection(): void
    {
        $tiger = Tiger::create('Wojtek');
        $elephant = Elephant::create('Maksim');

        $this->collection->addData([$tiger, $elephant]);

        $animals = [];
        foreach ($this->collection as $animal) {
            $animals[] = $animal;
        }

        $this->assertCount(2, $animals);
        $this->assertSame($tiger, $animals[0]);
        $this->assertSame($elephant, $animals[1]);
    }

    public function testRewindResetsIterator(): void
    {
        $this->collection->addData([
            Tiger::create('Wojtek'),
            Elephant::create('Maksim'),
        ]);

        // Iterate to the end
        foreach ($this->collection as $animal) {
        }

        // Rewind and check first element
        $this->collection->rewind();
        $this->assertSame($this->collection[0], $this->collection->current());
    }

    public function testIteratorKeyReturnsPosition(): void
    {
        $this->collection[] = Tiger::create('Wojtek');

        $this->assertSame(0, $this->collection->key());
    }

    public function testValidReturnsFalseForEmptyCollection(): void
    {
        $this->assertFalse($this->collection->valid());
    }
}
