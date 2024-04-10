<?php

declare(strict_types=1);

namespace App\Animal\Api;

use ArrayAccess;
use Countable;
use Iterator;

/**
 * Interface for anima collection classes
 *
 * @package App\Animal\Api
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
interface AnimalCollectionInterface extends ArrayAccess, Countable, Iterator
{
    public function addData(array $data): void;
}