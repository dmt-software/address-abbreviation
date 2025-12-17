<?php

namespace DMT\Test\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\Dutch\Street\PrepositionAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PrepositionAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviateMatchAtBeginning(string $street, string $expected): void
    {
        $this->assertEquals($expected, (new PrepositionAbbreviator())->abbreviate($street));
    }

    public static function addressProvider(): iterable
    {
        return [
            ['Aan de Hogeweg', 'Ad Hogeweg'],
            ['De van der Bergstraat', 'Dvd Bergstraat'],
            ['Achter de put', 'Ad put'],
            ['Laantje aan de zee', 'Laantje ad zee'],
        ];
    }

    #[DataProvider('addressProviderForInsideMatch')]
    public function testAbbreviateMatchInside(string $street, string $expected): void
    {
        $this->assertEquals($expected, (new PrepositionAbbreviator(matchInsideOnly: true))->abbreviate($street));
    }

    public static function addressProviderForInsideMatch(): iterable
    {
        return [
            ['Steeg achter de kerk', 'Steeg ad kerk'],
            ['Laantje aan de zee', 'Laantje ad zee'],
            ['Aan de Hogeweg', 'Aan de Hogeweg'],
        ];
    }
}
