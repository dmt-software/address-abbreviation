<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\Dutch\Street\AdjectiveAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\DirectionalIndicationAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\NumeralAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\PrepositionAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\TitlesAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\TitlesOfNobilityAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\ToSingleLetterAbbreviationGroupAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\TypeNameAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ToSingleLetterAbbreviationGroupAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $address, string $expected): void
    {
        $checkers = [
            new TypeNameAbbreviator(),
            new TitlesAbbreviator(),
            new AdjectiveAbbreviator(),
            new NumeralAbbreviator(),
            new DirectionalIndicationAbbreviator(),
            new PrepositionAbbreviator(),
            new TitlesOfNobilityAbbreviator(),
        ];

        $this->assertEquals(
            $expected,
            (new ToSingleLetterAbbreviationGroupAbbreviator($checkers, maxLength: 24))->abbreviate($address)
        );
    }

    public static function addressProvider(): iterable
    {
        return [
            ['Baron van Tuyll van Serooskerkenstr', 'Bar v T v Serooskerkenstr'],
            ['Bovenwindse eilanden strwg', 'B eilanden strwg'],
            ['Ged nieuwe grachtstr', 'Ged nieuwe grachtstr'],
            ['\'s-Heer Hendrikskinderenstr', '\'s-H Hendrikskinderenstr'],
            ['d\'Ablaing v Giessenburgstr', 'd\'A v Giessenburgstr'],
            ['Ln vd landinrichtingscommissie Duiven-Westervoort', 'Ln vd l Duiven-Westervoort'],
            ['Poort v Midden Gelderland Groen', 'P v M Gelderland Groen']
        ];
    }
}
