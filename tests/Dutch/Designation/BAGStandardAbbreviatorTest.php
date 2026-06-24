<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Designation;

use DMT\Address\Abbreviation\Dutch\Designation\BAGStandardAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class BAGStandardAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $designation, string $expected): void
    {
        $this->assertSame($expected, (new BAGStandardAbbreviator())->abbreviate($designation));
    }

    public static function addressProvider(): array
    {
        return [
            ['123', '123'],
            ['123 A', '123 A'],
            ['123-A', '123 A'],
            ['123 A1', '123 A1'],
            ['123-A1', '123 A1'],
            ['123 12', '123 12'],
            ['123-12', '123 12'],

            ['123 123', '123 123'],
            ['123 1234', '123 1234'],
            ['123-123', '123 123'],
            ['123-1234', '123 1234'],

            ['A', 'A'],
            ['A 123', 'A 123'],
            ['A-123', 'A 123'],
            ['A B12', 'A B12'],
            ['A-B12', 'A B12'],
            ['123 A extra text', '123 A'],
            ['123-A extra text', '123 A'],
            ['A 123 extra text', 'A 123'],

            ['123456 A', '123456 A'],
            ['0 A', '0 A'],
            ['ABC 123', 'ABC 123'],
            ['invalid designation', 'invalid designation'],
        ];
    }
}
