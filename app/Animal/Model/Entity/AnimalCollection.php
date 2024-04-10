<?php

declare(strict_types=1);

namespace App\Animal\Model\Entity;

use App\Animal\Api\AnimalCollectionInterface;
use App\Animal\Api\AnimalInterface;
use InvalidArgumentException;

/**
 * This is a collection class for animas
 *
 * @package App\Animal\Model\Entity
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class AnimalCollection implements AnimalCollectionInterface
{
    private array $animals = [];
    private array $animalUniqueKeys = [];
    private int $position = 0;

    public function __construct()
    {
        $this->rewind();
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof AnimalInterface) {
            throw new InvalidArgumentException('Invalid type of value. Expected AnimalInterface.');
        }

        $entyKey = get_class($value).$value->name();

        if (isset($this->animalUniqueKeys[$entyKey])) {
            throw new InvalidArgumentException('Animal of this kinde with identical name is already in collection');
        }

        if (is_null($offset)) {
            $this->animals[] = $value;
        } else {
            $this->animals[$offset] = $value;
        }

        $this->animalUniqueKeys[$entyKey] = true;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return isset($this->animals[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset): void
    {
        unset($this->animals[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): ?AnimalInterface
    {
        return $this->animals[$offset] ?? null;
    }

    /**
     * @param array $data
     * @return void
     */
    public function addData(array $data): void
    {
        foreach ($data as $offset => $value) {
            if (is_numeric($offset)) {
                $offset = null;
            }

            $this->offsetSet($offset, $value);
        }
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->animals);
    }

    /**
     * @inheritDoc
     */
    public function current(): mixed
    {
        return $this->animals[$this->position];
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @inheritDoc
     */
    public function key(): mixed
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return isset($this->animals[$this->position]);
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->position = 0;
    }
}