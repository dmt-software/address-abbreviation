<?php

namespace DMT\Test\Address\Abbreviation\Dutch\Designation;

use DMT\Address\Abbreviation\Dutch\Designation\SeparatorAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SeparatorAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $designation, string $expected): void
    {
        $this->assertEquals($expected, (new SeparatorAbbreviator())->abbreviate($designation));
    }

    public static function addressProvider(): iterable
    {
        return [
            ['G ', 'G'],
            ['324', '324'],
            ['100A', '100 A'],
            ['A 100', 'A 100'],
            ['B-2', 'B 2'],
            ['C.3', 'C 3'],
            ['A B12', 'A B12'],
            ['C-D', 'C D'],
            ['4.20', '4-20'],
            [' 13  B', '13 B'],
            ['12 - C08', '12 C08'],
            ['2-10.4', '2-10 4'],
            // error in designation: expect addition only
            ['-132', '-132'],
            ['.123', '.123'],
        ];
    }
}
