<?php

declare(strict_types=1);

namespace Tests\Unit\Animal\Attributes;

use App\Animal\Model\Attributes\Name;
use Assert\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function testCreatesNameFromValidString(): void
    {
        $name = Name::fromString('Wojtek');

        $this->assertInstanceOf(Name::class, $name);
    }

    public function testToStringReturnsValue(): void
    {
        $name = Name::fromString('Wojtek');

        $this->assertSame('Wojtek', (string) $name);
    }

    public function testEqualsReturnsTrueForSameName(): void
    {
        $name1 = Name::fromString('Wojtek');
        $name2 = Name::fromString('Wojtek');

        $this->assertTrue($name1->equals($name2));
    }

    public function testEqualsReturnsFalseForDifferentName(): void
    {
        $name1 = Name::fromString('Wojtek');
        $name2 = Name::fromString('Ania');

        $this->assertFalse($name1->equals($name2));
    }

    public function testAcceptsMinimumLengthName(): void
    {
        $name = Name::fromString('abc');

        $this->assertSame('abc', (string) $name);
    }

    public function testAcceptsMaximumLengthName(): void
    {
        $value = str_repeat('a', 100);
        $name = Name::fromString($value);

        $this->assertSame($value, (string) $name);
    }

    public function testRejectsTooShortName(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Name::fromString('ab');
    }

    public function testRejectsTooLongName(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Name::fromString(str_repeat('a', 101));
    }

    public function testRejectsEmptyName(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Name::fromString('');
    }

    public function testAcceptsUnicodeCharacters(): void
    {
        $name = Name::fromString('Maryś');

        $this->assertSame('Maryś', (string) $name);
    }
}
