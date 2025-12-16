<?php

namespace DMT\Test\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\Dutch\Street\NumeralAbbreviation;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class NumeralAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $street, string $expected): void
    {
        $this->assertEquals($expected, (new NumeralAbbreviation())->abbreviate($street));
    }

    public static function addressProvider(): iterable
    {
        return [
            ['Zijpad een', 'Zijpad 1'],
            ['Zijpad twee', 'Zijpad 2'],
            ['Zijpad drie', 'Zijpad 3'],
            ['Zijpad vier', 'Zijpad 4'],
            ['Zijpad vijf', 'Zijpad 5'],
            ['Zijpad zes', 'Zijpad 6'],
            ['Zijpad zeven', 'Zijpad 7'],
            ['Zijpad acht', 'Zijpad 8'],
            ['Zijpad negen', 'Zijpad 9'],
            ['Zijpad tien', 'Zijpad 10'],
            ['Zijpad elf', 'Zijpad 11'],
            ['Zijpad twaalf', 'Zijpad 12'],
            ['Zijpad dertien', 'Zijpad 13'],
            ['Zijpad veertien', 'Zijpad 14'],
            ['Zijpad vijftien', 'Zijpad 15'],
            ['Zijpad zestien', 'Zijpad 16'],
            ['Zijpad zeventien', 'Zijpad 17'],
            ['Zijpad achttien', 'Zijpad 18'],
            ['Zijpad negentien', 'Zijpad 19'],
            ['Zijpad twintig', 'Zijpad 20'],
            ['Zijpad eenentwintig', 'Zijpad 21'],
            ['Zijpad tweeëntwintig', 'Zijpad 22'],
            ['Zijpad drieëntwintig', 'Zijpad 23'],
            ['Zijpad vierentwintig', 'Zijpad 24'],
            ['Zijpad vijfentwintig', 'Zijpad 25'],
            ['Eerste dwarsstraat', '1e dwarsstraat'],
            ['Tweede dwarsstraat', '2e dwarsstraat'],
            ['Derde dwarsstraat', '3e dwarsstraat'],
            ['Vierde dwarsstraat', '4e dwarsstraat'],
            ['Vijfde dwarsstraat', '5e dwarsstraat'],
            ['Zesde dwarsstraat', '6e dwarsstraat'],
            ['Zevende dwarsstraat', '7e dwarsstraat'],
            ['Achtste dwarsstraat', '8e dwarsstraat'],
            ['Negende dwarsstraat', '9e dwarsstraat'],
            ['Tiende dwarsstraat', '10e dwarsstraat'],
            ['Elfde dwarsstraat', '11e dwarsstraat'],
            ['Twaalfde dwarsstraat', '12e dwarsstraat'],
            ['Dertiende dwarsstraat', '13e dwarsstraat'],
            ['Veertiende dwarsstraat', '14e dwarsstraat'],
            ['Vijftiende dwarsstraat', '15e dwarsstraat'],
            ['Zestiende dwarsstraat', '16e dwarsstraat'],
            ['Zeventiende dwarsstraat', '17e dwarsstraat'],
            ['Achttiende dwarsstraat', '18e dwarsstraat'],
            ['Negentiende dwarsstraat', '19e dwarsstraat'],
            ['Twintigste dwarsstraat', '20e dwarsstraat'],
            ['Eenentwintigste dwarsstraat', '21e dwarsstraat'],
            ['Tweeëntwintigste dwarsstraat', '22e dwarsstraat'],
            ['Drieëntwintigste dwarsstraat', '23e dwarsstraat'],
            ['Vierentwintigste dwarsstraat', '24e dwarsstraat'],
            ['Vijfentwintigste dwarsstraat', '25e dwarsstraat'],
            ['Haven I', 'Haven 1'],
            ['Haven II', 'Haven 2'],
            ['Haven III', 'Haven 3'],
            ['Haven IV', 'Haven 4'],
            ['Haven V', 'Haven 5'],
            ['Haven VI', 'Haven 6'],
            ['Haven VII', 'Haven 7'],
            ['Haven VIII', 'Haven 8'],
            ['Haven IX', 'Haven 9'],
            ['Haven X', 'Haven 10'],
            ['Haven XI', 'Haven 11'],
            ['Haven XII', 'Haven 12'],
            ['Haven XIII', 'Haven 13'],
            ['Haven XIV', 'Haven 14'],
            ['Haven XV', 'Haven 15'],
            ['Haven XVI', 'Haven 16'],
            ['Haven XVII', 'Haven 17'],
            ['Haven XVIII', 'Haven 18'],
            ['Haven XIX', 'Haven 19'],
            ['Haven XX', 'Haven 20'],
            ['Haven XXI', 'Haven 21'],
            ['Haven XXII', 'Haven 22'],
            ['Haven XXIII', 'Haven 23'],
            ['Haven XXIV', 'Haven 24'],
            ['Haven XXV', 'Haven 25'],
            // ensure roman numerals are case sensitive
            ['Haven xxvi', 'Haven xxvi'],
        ];
    }
}
