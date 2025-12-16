<?php

namespace DMT\Test\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\Dutch\Street\AdjectiveAbbreviation;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AdjectiveAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $street, string $expected): void
    {
        $this->assertEquals($expected, (new AdjectiveAbbreviation())->abbreviate($street));
    }

    public static function addressProvider(): iterable
    {
        return [
            ['Gedempte Voldersgracht', 'Ged Voldersgracht'],
            ['Groot Heiligland', 'Grt Heiligland'],
            ['Kleine Houtstraat', 'Kl Houtstraat'],
            ['Westelijke Randweg', 'Westel Randweg'],
            ['De nieuwe Meer', 'De nieuwe Meer'],
        ];
    }
}
