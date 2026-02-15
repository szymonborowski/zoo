<?php

declare(strict_types=1);

namespace App\Animal\Model\Entity;

use App\Animal\Api\AnimalInterface;
use App\Animal\Model\Attributes\DietOption;
use App\Animal\Model\Attributes\Name;
use App\Animal\Model\Behavior\CanEatTrait;

/**
 * This class provide abstraction for all animal specific classes
 *
 * @package App\Animal\Model\Entity
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
abstract class AnimalAbstract implements AnimalInterface
{
    use CanEatTrait;

    protected const string SPECIES = '';

    public function __construct(
        private readonly Name $name,
        private readonly DietOption $diet
    ) {
    }

    abstract public static function create(string $name): self;

    #[\Override]
    public function name(): Name
    {
        return $this->name;
    }

    #[\Override]
    public function diet(): DietOption
    {
        return $this->diet;
    }

    public function __toString(): string
    {
        return 'I am ' . static::SPECIES . ' ' . $this->name() . ' !';
    }
}