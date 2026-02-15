<?php

declare(strict_types=1);

namespace Tests\Unit\Animal\Factory;

use App\Animal\Api\EatBehaviorInterface;
use App\Animal\Api\CombBehaviorInterface;
use App\Animal\Factory\CombBehavior;
use App\Animal\Factory\MealBehavior;
use App\Animal\Model\Behavior\Actions\Comb;
use App\Animal\Model\Behavior\Actions\EatCarnivoreMeal;
use App\Animal\Model\Behavior\Actions\EatHerbivoreMeal;
use App\Animal\Model\Behavior\Actions\EatOmnivoreMeal;
use App\Animal\Model\Entity\Elephant;
use App\Animal\Model\Entity\Fox;
use App\Animal\Model\Entity\Tiger;
use PHPUnit\Framework\TestCase;

class MealBehaviorTest extends TestCase
{
    public function testReturnsCarnivoreEatBehaviorForCarnivore(): void
    {
        $tiger = Tiger::create('Wojtek');

        $behavior = MealBehavior::getBehavior($tiger);

        $this->assertInstanceOf(EatBehaviorInterface::class, $behavior);
        $this->assertInstanceOf(EatCarnivoreMeal::class, $behavior);
    }

    public function testReturnsHerbivoreEatBehaviorForHerbivore(): void
    {
        $elephant = Elephant::create('Maksim');

        $behavior = MealBehavior::getBehavior($elephant);

        $this->assertInstanceOf(EatBehaviorInterface::class, $behavior);
        $this->assertInstanceOf(EatHerbivoreMeal::class, $behavior);
    }

    public function testReturnsOmnivoreEatBehaviorForOmnivore(): void
    {
        $fox = Fox::create('Maryś');

        $behavior = MealBehavior::getBehavior($fox);

        $this->assertInstanceOf(EatBehaviorInterface::class, $behavior);
        $this->assertInstanceOf(EatOmnivoreMeal::class, $behavior);
    }

    public function testCombBehaviorFactoryReturnsComb(): void
    {
        $tiger = Tiger::create('Wojtek');

        $behavior = CombBehavior::getBehavior($tiger);

        $this->assertInstanceOf(CombBehaviorInterface::class, $behavior);
        $this->assertInstanceOf(Comb::class, $behavior);
    }
}
