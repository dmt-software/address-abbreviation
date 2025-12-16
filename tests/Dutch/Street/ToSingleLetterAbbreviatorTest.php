<?php

namespace DMT\Test\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\Dutch\Street\AdjectiveAbbreviation;
use DMT\Address\Abbreviation\Dutch\Street\DirectionalIndicationAbbreviation;
use DMT\Address\Abbreviation\Dutch\Street\NumeralAbbreviation;
use DMT\Address\Abbreviation\Dutch\Street\PrepositionAbbreviation;
use DMT\Address\Abbreviation\Dutch\Street\TitlesAbbreviation;
use DMT\Address\Abbreviation\Dutch\Street\TitlesOfNobilityAbbreviation;
use DMT\Address\Abbreviation\Dutch\Street\ToSingleLetterAbbreviation;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ToSingleLetterAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $address, string $expected): void
    {
        $checkers = [
            new TitlesAbbreviation(),
            new AdjectiveAbbreviation(),
            new NumeralAbbreviation(),
            new DirectionalIndicationAbbreviation(),
            new PrepositionAbbreviation(),
            new TitlesOfNobilityAbbreviation(),
        ];

        $this->assertEquals($expected, (new ToSingleLetterAbbreviation($checkers))->abbreviate($address));
    }

    public static function addressProvider(): iterable
    {
        return [
            ['Baron van Tuyll van Serooskerkenstr', 'B v T v Serooskerkenstr'],
            ['Bovenwindse eilanden ln', 'B eilanden ln'],
            ['Ged nieuwe grachtstr', 'Ged n grachtstr'],
            ['Hoogewg ad duinen', 'Hoogewg ad duinen'],
            ['\'s-Heer Hendrikskinderenstr', '\'s-H Hendrikskinderenstr'],
            ['d\'Ablaing v Giessenburgstr', 'd\'A v Giessenburgstr'],
        ];
    }
}
