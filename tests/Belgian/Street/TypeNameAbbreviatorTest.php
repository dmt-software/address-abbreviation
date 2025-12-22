<?php

namespace DMT\Test\Address\Abbreviation\Belgian\Street;

use DMT\Address\Abbreviation\Belgian\Street\TypeNameAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class TypeNameAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $street, string $expected): void
    {
        $this->assertEquals($expected, (new TypeNameAbbreviator())->abbreviate($street));
    }

    public static function addressProvider(): iterable
    {
        return [
            ['Aarlenstraat', 'Aarlenstr.'],
            ['Rue d\'Arlon', 'Rue d\'Arlon'],
            ['Albert Giraudlaan', 'Albert Giraudln'],
            ['Avenue Albert Giraud', 'Av. Albert Giraud'],
            ['Oude Steenweg op Haacht', 'Oude Stwg op Haacht'],
            ['Ancienne chaussée de Haecht', 'Ancienne Chée de Haecht'],
            ['Haubtstrasse', 'Haubtstr.'],
            ['Berliner Straße', 'Berliner Str.'],
        ];
    }
}
