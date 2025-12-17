<?php

namespace DMT\Test\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\Dutch\Street\DirectionalIndicationAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class DirectionalIndicationAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $street, string $expected): void
    {
        $this->assertEquals($expected, (new DirectionalIndicationAbbreviator())->abbreviate($street));
    }

    public static function addressProvider(): iterable
    {
        return [
            ['Companie Noord', 'Companie N'],
            ['Companie Oost', 'Companie O'],
            ['Companie Zuid', 'Companie Z'],
            ['Companie West', 'Companie W'],
            ['Hoofdvaart noordzijde', 'Hoofdvaart Nz'],
            ['Hoofdvaart oostzijde', 'Hoofdvaart Oz'],
            ['Hoofdvaart zuidzijde', 'Hoofdvaart Zz'],
            ['Hoofdvaart westzijde', 'Hoofdvaart Wz'],
        ];
    }
}
