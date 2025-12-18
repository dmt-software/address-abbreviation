<?php

namespace DMT\Test\Address\Abbreviation;

use DMT\Address\Abbreviation\AbbreviationGroupFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AbbreviationGroupFactoryTest extends TestCase
{
    #[DataProvider('nen5825AbbreviationProvider')]
    public function testGetNen5825AbbreviationGroup(string $street, string $expected): void
    {
        $nen5825Abbreviator = (new AbbreviationGroupFactory())->getNen5825AbbreviationGroup();

        $this->assertEquals($expected, $nen5825Abbreviator->abbreviate($street));
    }

    public static function nen5825AbbreviationProvider(): iterable
    {
        return [
            ['W. van Eertenstraat', 'W. van Eertenstraat'],
            ['Burg. W. van Eertenstraat', 'Burg W van Eertenstraat'],
            ['Westerbeek van Eertenstraat', 'Westerbeek van Eertenstr'],
            ['E. Westerbeek van Eertenstraat', 'E Westerbeek v Eertenstr'],
            ['Burgemeester Westerbeek van Eertenstraat', 'Burg W v Eertenstr'],
            ['Burgemeester W. van Eertenstraat', 'Burg W van Eertenstraat'],
            ['E.R. Westerbeek van Eertenstraat', 'E R W v Eertenstr'],
            ['Burgemeester E.R. Westerbeek van Eertenstraat', 'Burg E R W v Eertenstr'],
            ['Burgemeester Baron van Voorst tot Voorstweg', 'Burg Bar v V t Voorstwg'],
            ['Wethouder F.E. Meerburg sr. kade', 'Weth F E Meerburg sr kd']
        ];
    }

    #[DataProvider('bagStandardAbbreviationProvider')]
    public function testGetDesignationBagStandardGroup(string $designation, string $expected): void
    {
        $bagStandardAbbreviator = (new AbbreviationGroupFactory())->getDesignationBAGStandardAbbreviationGroup();

        $this->assertEquals($expected, $bagStandardAbbreviator->abbreviate($designation));
    }

    public static function bagStandardAbbreviationProvider(): iterable
    {
        return [
            ['12 B', '12 B'],
            ['45 huis onderste bel', '45 H'],
            ['52 IIV', '52 IIV'],
            ['4.20', '4-20'],
            ['2 bis', '2 BIS'],
            ['100 begane grond', '100 BG'],
            ['8 rood 2', '8 RD2'],
            ['3 rood', '3 RD'],
            ['75 zwart (onder)', '75 ZW'],
            ['4 A bis', '4 ABIS'],
            ['12 bis 04', '12 BS04'],
            ['12-4.20', '12-4 20'],
            ['12-4 eerste verdieping', '12-4'],
            ['12-4 1e verdieping', '12-4'],
            ['32 tussen 3 en 4', '32'],
        ];
    }

}
