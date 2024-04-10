<?php

declare(strict_types=1);

namespace App\Animal\Model\Behavior\Actions;

use App\Animal\Api\AnimalInterface;

class BehaviorAbstract
{
    public function __construct(protected readonly ?AnimalInterface $animal)
    {
    }
}