<?php

namespace DMT\Test\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\Dutch\Street\AdjectiveAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\DirectionalIndicationAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\NumeralAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\PrepositionAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\TitlesAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\TitlesOfNobilityAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\ToSingleLetterAbbreviationGroupAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ToSingleLetterAbbreviationGroupAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $address, string $expected): void
    {
        $checkers = [
            new TitlesAbbreviator(),
            new AdjectiveAbbreviator(),
            new NumeralAbbreviator(),
            new DirectionalIndicationAbbreviator(),
            new PrepositionAbbreviator(),
            new TitlesOfNobilityAbbreviator(),
        ];

        $this->assertEquals($expected, (new ToSingleLetterAbbreviationGroupAbbreviator($checkers))->abbreviate($address));
    }

    public static function addressProvider(): iterable
    {
        return [
            ['Baron van Tuyll van Serooskerkenstr', 'Bar v T v Serooskerkenstr'],
            ['Bovenwindse eilanden ln', 'B eilanden ln'],
            ['Ged nieuwe grachtstr', 'Ged n grachtstr'],
            ['Hoogewg ad duinen', 'Hoogewg ad duinen'],
            ['\'s-Heer Hendrikskinderenstr', '\'s-H Hendrikskinderenstr'],
            ['d\'Ablaing v Giessenburgstr', 'd\'A v Giessenburgstr'],
            ['Ln vd landinrichtingscommissie Duiven-Westervoort', 'Ln vd l Duiven-Westervoort']
        ];
    }
}
