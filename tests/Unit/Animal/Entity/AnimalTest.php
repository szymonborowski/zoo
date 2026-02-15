<?php

declare(strict_types=1);

namespace Tests\Unit\Animal\Entity;

use App\Animal\Api\AnimalInterface;
use App\Animal\Model\Attributes\DietOption;
use App\Animal\Model\Entity\Elephant;
use App\Animal\Model\Entity\Fox;
use App\Animal\Model\Entity\Rabbit;
use App\Animal\Model\Entity\Rhinoceros;
use App\Animal\Model\Entity\SnowLeopard;
use App\Animal\Model\Entity\Tiger;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AnimalTest extends TestCase
{
    public static function animalProvider(): array
    {
        return [
            'Tiger' => [Tiger::class, 'Wojtek', DietOption::Carnivore, true],
            'SnowLeopard' => [SnowLeopard::class, 'Zuzia', DietOption::Carnivore, true],
            'Fox' => [Fox::class, 'Maryś', DietOption::Omnivore, true],
            'Elephant' => [Elephant::class, 'Maksim', DietOption::Herbivore, false],
            'Rabbit' => [Rabbit::class, 'Renia', DietOption::Herbivore, true],
            'Rhinoceros' => [Rhinoceros::class, 'Bartek', DietOption::Herbivore, false],
        ];
    }

    #[DataProvider('animalProvider')]
    public function testCreateReturnsAnimalInterface(string $class, string $name, DietOption $diet, bool $hasFur): void
    {
        $animal = $class::create($name);

        $this->assertInstanceOf(AnimalInterface::class, $animal);
    }

    #[DataProvider('animalProvider')]
    public function testAnimalHasCorrectName(string $class, string $name, DietOption $diet, bool $hasFur): void
    {
        $animal = $class::create($name);

        $this->assertSame($name, (string) $animal->name());
    }

    #[DataProvider('animalProvider')]
    public function testAnimalHasCorrectDiet(string $class, string $name, DietOption $expectedDiet, bool $hasFur): void
    {
        $animal = $class::create($name);

        $this->assertSame($expectedDiet, $animal->diet());
    }

    #[DataProvider('animalProvider')]
    public function testToStringContainsSpeciesAndName(string $class, string $name, DietOption $diet, bool $hasFur): void
    {
        $animal = $class::create($name);
        $shortName = (new \ReflectionClass($animal))->getShortName();

        $this->assertSame("I am {$shortName} {$name} !", (string) $animal);
    }

    #[DataProvider('animalProvider')]
    public function testEatOutputsCorrectMessage(string $class, string $name, DietOption $diet, bool $hasFur): void
    {
        $animal = $class::create($name);
        $shortName = (new \ReflectionClass($animal))->getShortName();

        $expectedMeal = match ($diet) {
            DietOption::Carnivore => "I'm eating meat!",
            DietOption::Herbivore => "I'm eating vegetables!",
            DietOption::Omnivore => "I'm eating vegetables and meat!",
        };

        $this->expectOutputString("{$shortName} {$name} {$expectedMeal}\n");

        $animal->eat();
    }

    #[DataProvider('animalProvider')]
    public function testCombOutputsCorrectMessageForFurryAnimals(string $class, string $name, DietOption $diet, bool $hasFur): void
    {
        $animal = $class::create($name);

        if (!$hasFur) {
            $this->assertFalse(method_exists($animal, 'comb'));
            return;
        }

        $shortName = (new \ReflectionClass($animal))->getShortName();
        $this->expectOutputString("{$shortName} {$name} Humans combing me!\n");

        $animal->comb();
    }

    public function testCanCombTraitIsOnlyOnFurryAnimals(): void
    {
        $furry = [Tiger::class, SnowLeopard::class, Fox::class, Rabbit::class];
        $notFurry = [Elephant::class, Rhinoceros::class];

        foreach ($furry as $class) {
            $this->assertTrue(
                method_exists($class::create('Test'), 'comb'),
                "{$class} should have comb() method"
            );
        }

        foreach ($notFurry as $class) {
            $this->assertFalse(
                method_exists($class::create('Test'), 'comb'),
                "{$class} should not have comb() method"
            );
        }
    }
}
