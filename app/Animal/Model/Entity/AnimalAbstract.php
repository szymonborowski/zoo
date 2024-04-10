<?php

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

    public function __construct(
        readonly private Name $name,
        readonly private DietOption $diet
    ) {
    }

    abstract public static function create(string $name): self;

    public function name(): Name
    {
        return $this->name;
    }

    public function diet(): DietOption
    {
        return $this->diet;
    }
}