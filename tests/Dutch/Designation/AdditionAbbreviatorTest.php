<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Designation;

use DMT\Address\Abbreviation\Dutch\Designation\AdditionAbbreviator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class AdditionAbbreviatorTest extends TestCase
{
    #[DataProvider('addressProvider')]
    public function testAbbreviate(string $designation, string $expected): void
    {
        $this->assertSame($expected, (new AdditionAbbreviator())->abbreviate($designation));
    }

    public static function addressProvider(): array
    {
        return [
            ['123 rood', '123 RD'],
            ['123 rd', '123 RD'],
            ['123 zwart', '123 ZW'],
            ['123 zw', '123 ZW'],
            ['123 RD 1', '123 RD1'],
            ['123 ZW 2', '123 ZW2'],
            ['123 A 2', '123 A 2'],
            ['123 bis', '123 BIS'],
            ['123 bs', '123 BIS'],
            ['123 bis 1', '123 BS1'],
            ['123 bs 2', '123 BS2'],
            ['123 A bis', '123 ABIS'],
            ['123 A bs', '123 ABIS'],
            ['123 1 bis', '123 1BS'],
            ['123 12 bs', '123 12BS'],
            ['123 2 hoog', '123 2 hoog'],
        ];
    }
}
