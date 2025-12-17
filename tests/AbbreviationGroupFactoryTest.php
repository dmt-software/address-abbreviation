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
        $nen5825Abbreviator =(new AbbreviationGroupFactory())->getNen5825AbbreviationGroup();

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
}
