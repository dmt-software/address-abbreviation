<?php

namespace DMT\Test\Address\Abbreviation\Dutch\Designation;

use DMT\Address\Abbreviation\Dutch\Designation\RomanNumeralAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RomanNumeralAbbreviatorTest extends TestCase
{
    #[DataProvider('numeralProvider')]
    public function testAbbreviate(string $phrase, string $expected): void
    {
        $this->assertEquals($expected, (new RomanNumeralAbbreviator())->abbreviate($phrase));
    }

    public static function numeralProvider(): iterable
    {
        return [
            ['17 I', '17 1'],
            ['45 II', '45 2'],
            ['1-IX', '1-9'],
            ['3 X', '3 10'],
            ['19/XIV', '19/14'],
            ['1 I with extra text', '1 1 with extra text'],
            // max 19
            ['22 XX', '22 XX'],
            ['40 XL', '40 XL'],
            // case-sensitive
            ['1 iii', '1 iii'],
            ['24 Iv', '24 Iv'],
            // no house number
            ['X', 'X'],
            // numerals part of addition
            ['2 A-XII', '2 A-XII'],
            // addition is no numeral but part of a letter-number addition
            ['25 V 12', '25 V 12'],
        ];
    }
}
