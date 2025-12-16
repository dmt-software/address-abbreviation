<?php

namespace DMT\Test\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\Dutch\Street\TypeNameAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class TypeNameAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $street, string $expected): void
    {
        $this->assertEquals($expected, (new TypeNameAbbreviator())->abbreviate($street));
    }

    public static function addressProvider(): iterable
    {
        return [
            ['Haven van Rotterdam', 'Hvn van Rotterdam'],
            ['4e dwarsstraat', '4e dwstr'],
            ['Dreef', 'Dr'],
            ['Schoutjeslaantje', 'Schoutjesln'],
        ];
    }
}
