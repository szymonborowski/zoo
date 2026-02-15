<?php

declare(strict_types=1);

namespace Tests\Unit\Animal\Behavior;

use App\Animal\Model\Behavior\Actions\Comb;
use App\Animal\Model\Behavior\Actions\EatCarnivoreMeal;
use App\Animal\Model\Behavior\Actions\EatHerbivoreMeal;
use App\Animal\Model\Behavior\Actions\EatOmnivoreMeal;
use App\Animal\Model\Entity\Elephant;
use App\Animal\Model\Entity\Fox;
use App\Animal\Model\Entity\Tiger;
use PHPUnit\Framework\TestCase;

class BehaviorActionsTest extends TestCase
{
    public function testEatCarnivoreMealOutputsMeatMessage(): void
    {
        $tiger = Tiger::create('Wojtek');
        $behavior = new EatCarnivoreMeal($tiger);

        $this->expectOutputString("Tiger Wojtek I'm eating meat!\n");

        $behavior->behave();
    }

    public function testEatHerbivoreMealOutputsVegetablesMessage(): void
    {
        $elephant = Elephant::create('Maksim');
        $behavior = new EatHerbivoreMeal($elephant);

        $this->expectOutputString("Elephant Maksim I'm eating vegetables!\n");

        $behavior->behave();
    }

    public function testEatOmnivoreMealOutputsMixedMessage(): void
    {
        $fox = Fox::create('Maryś');
        $behavior = new EatOmnivoreMeal($fox);

        $this->expectOutputString("Fox Maryś I'm eating vegetables and meat!\n");

        $behavior->behave();
    }

    public function testCombOutputsCombingMessage(): void
    {
        $tiger = Tiger::create('Wojtek');
        $behavior = new Comb($tiger);

        $this->expectOutputString("Tiger Wojtek Humans combing me!\n");

        $behavior->behave();
    }

    public function testEatCarnivoreMealWithNullAnimalOutputsNothing(): void
    {
        $behavior = new EatCarnivoreMeal(null);

        $this->expectOutputString('');

        $behavior->behave();
    }

    public function testEatHerbivoreMealWithNullAnimalOutputsNothing(): void
    {
        $behavior = new EatHerbivoreMeal(null);

        $this->expectOutputString('');

        $behavior->behave();
    }

    public function testEatOmnivoreMealWithNullAnimalOutputsNothing(): void
    {
        $behavior = new EatOmnivoreMeal(null);

        $this->expectOutputString('');

        $behavior->behave();
    }

    public function testCombWithNullAnimalOutputsNothing(): void
    {
        $behavior = new Comb(null);

        $this->expectOutputString('');

        $behavior->behave();
    }
}
