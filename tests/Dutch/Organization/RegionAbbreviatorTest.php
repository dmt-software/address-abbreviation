<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\Dutch\Organization\RegionAbbreviator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(RegionAbbreviator::class)]
final class RegionAbbreviatorTest extends TestCase
{
    #[DataProvider('provideRegionNames')]
    public function testAbbreviatesRegionNames(string $phrase, string $expected): void
    {
        $abbreviator = new RegionAbbreviator();

        $this->assertSame($expected, $abbreviator->abbreviate($phrase));
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function provideRegionNames(): iterable
    {
        return [
            'nederlandse' => [
                'Nederlandse Vereniging',
                'Ned Vereniging',
            ],
            'nederlands' => [
                'Nederlands Instituut',
                'Ned Instituut',
            ],
            'nederland' => [
                'Stichting Zorg Nederland',
                'Stichting Zorg NL',
            ],
            'internationaal lowercase' => [
                'internationaal bureau',
                'intl bureau',
            ],
            'internationaal uppercase' => [
                'Internationaal Bureau',
                'Intl Bureau',
            ],
            'nationaal' => [
                'Nationaal Fonds',
                'Nat Fonds',
            ],
            'regionaal' => [
                'Regionaal Opleidingscentrum',
                'Reg Opleidingscentrum',
            ],
            'centraal' => [
                'Centraal Bureau',
                'Centr Bureau',
            ],
            'noord' => [
                'Zorggroep Noord',
                'Zorggroep N',
            ],
            'zuid' => [
                'Zorggroep Zuid',
                'Zorggroep Z',
            ],
            'oost' => [
                'Zorggroep Oost',
                'Zorggroep O',
            ],
            'west' => [
                'Zorggroep West',
                'Zorggroep W',
            ],
            'case insensitive' => [
                'zorggroep NOORD',
                'zorggroep N',
            ],
            'multiple regions' => [
                'Regionaal Centrum Noord West',
                'Reg Centrum N W',
            ],
            'does not abbreviate inside word' => [
                'Noorderlicht Stichting',
                'Noorderlicht Stichting',
            ],
            'does not abbreviate partial word' => [
                'Nederlanderschap Stichting',
                'Nederlanderschap Stichting',
            ],
        ];
    }

    #[DataProvider('provideAbbreviatedRegionNames')]
    public function testDetectsAbbreviatedRegionNames(string $word): void
    {
        $abbreviator = new RegionAbbreviator();

        $this->assertTrue($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideAbbreviatedRegionNames(): iterable
    {
        return [
            'Ned' => ['Ned'],
            'nl' => ['nl'],
            'Intl' => ['Intl'],
            'nat' => ['nat'],
            'reg' => ['reg'],
            'Centr' => ['Centr'],
            'n' => ['n'],
            'Z' => ['Z'],
            'o' => ['o'],
            'W' => ['W'],
        ];
    }

    #[DataProvider('provideUnabbreviatedRegionNames')]
    public function testDoesNotDetectUnabbreviatedRegionNames(string $word): void
    {
        $abbreviator = new RegionAbbreviator();

        $this->assertFalse($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideUnabbreviatedRegionNames(): iterable
    {
        return [
            'nederland' => ['nederland'],
            'nederlandse' => ['nederlandse'],
            'internationaal' => ['internationaal'],
            'regionaal' => ['regionaal'],
            'noord' => ['noord'],
            'empty string' => [''],
        ];
    }
}
