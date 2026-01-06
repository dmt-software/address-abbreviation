<?php

namespace DMT\Test\Address\Abbreviation\Belgian\Street;

use DMT\Address\Abbreviation\Belgian\Street\TitlesAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class TitlesAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $street, string $expected): void
    {
        $this->assertEquals($expected, (new TitlesAbbreviator())->abbreviate($street));
    }

    public static function addressProvider(): iterable
    {
        return [
            ['Koning Willem I straat', 'Kon. Willem I straat'],
            ['Doctorandus ingenieur Willemstraat', 'Drs. ir. Willemstraat'],
            ['Luitenant-Generaal de Keistraat', 'Lt Gen. de Keistraat'],
            ['Professor doctorandus ingenieur Willemstraat', 'Prof. drs. ir. Willemstraat'],
        ];
    }
}
