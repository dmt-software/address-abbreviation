<?php

namespace DMT\Test\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\Dutch\Street\TitlesAbbreviator;
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
            ['Dokter Jan van Gentstraat', 'Dr Jan van Gentstraat'],
            ['Schout bij Nacht De Kroon', 'Sbn De Kroon'],
            ['Doctorandus Ingenieur Willemstraat', 'Drs Ir Willemstraat'],
            ['Luitenant Generaal de Keistraat', 'Lt Gen de Keistraat'],
            ['Professor Doctorandus Ingenieur Willemstraat', 'Prof Drs Ingenieur Willemstraat'],
        ];
    }
}
