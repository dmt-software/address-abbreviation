<?php

namespace DMT\Test\Address\Abbreviation\General;

use DMT\Address\Abbreviation\General\PunctuationAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PunctuationAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $street, string $expected): void
    {
        $this->assertEquals($expected, (new PunctuationAbbreviator())->abbreviate($street));
    }

    public static function addressProvider(): iterable
    {
        return [
            ['Dr. Jan van der Koppelstraat', 'Dr Jan van der Koppelstraat'],
            ['Ir. Lelylaan', 'Ir Lelylaan'],
            ['Drieëndertigste Leibaan.', 'Drieëndertigste Leibaan']
        ];
    }
}
