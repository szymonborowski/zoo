<?php

declare(strict_types=1);

namespace App\Animal\Model\Attributes;

use Assert\Assertion;

/**
 * This class provide interface for interaction with animals name.
 * Using this type of class prevent from creating animal with invalid attributes.
 *
 * @package App\Animal\Entity\Attribute
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
final class Name
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;

    private function __construct(private readonly string $value)
    {
        Assertion::between(
            strlen($value),
            self::MIN_LENGTH,
            self::MAX_LENGTH,
            "Name length must be between 3 and 100 characters."
        );
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function equals(self $otherName): bool
    {
        return $this->value === ((string)$otherName);
    }

    public function __toString()
    {
        return $this->value;
    }
}