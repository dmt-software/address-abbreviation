<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\Dutch\Organization\UniversityAbbreviator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(UniversityAbbreviator::class)]
final class UniversityAbbreviatorTest extends TestCase
{
    #[DataProvider('provideUniversities')]
    public function testAbbreviatesUniversities(string $phrase, string $expected): void
    {
        $abbreviator = new UniversityAbbreviator();

        $this->assertSame($expected, $abbreviator->abbreviate($phrase));
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function provideUniversities(): iterable
    {
        return [
            'universiteit utrecht' => [
                'Universiteit Utrecht',
                'UU',
            ],
            'universiteit leiden' => [
                'Universiteit Leiden',
                'LEI',
            ],
            'erasmus universiteit rotterdam' => [
                'Erasmus Universiteit Rotterdam',
                'EUR',
            ],
            'radboud universiteit' => [
                'Radboud Universiteit',
                'RU',
            ],
            'open universiteit' => [
                'Open Universiteit',
                'OU',
            ],
            'universiteit van amsterdam' => [
                'Universiteit van Amsterdam',
                'UvA',
            ],
            'vrije universiteit amsterdam' => [
                'Vrije Universiteit Amsterdam',
                'VU',
            ],
            'rijksuniversiteit groningen' => [
                'Rijksuniversiteit Groningen',
                'RUG',
            ],
            'technische universiteit eindhoven' => [
                'Technische Universiteit Eindhoven',
                'TU/e',
            ],
            'technische universiteit delft' => [
                'Technische Universiteit Delft',
                'TUD',
            ],
            'universiteit twente' => [
                'Universiteit Twente',
                'UT',
            ],
            'tilburg university' => [
                'Tilburg University',
                'TiU',
            ],
            'wageningen university & research' => [
                'Wageningen University & Research',
                'WUR',
            ],
            'wageningen university and research' => [
                'Wageningen University and Research',
                'WUR',
            ],
            'case insensitive' => [
                'universiteit UTRECHT',
                'UU',
            ],
            'inside sentence' => [
                'Stichting Vrienden van de Universiteit Utrecht',
                'Stichting Vrienden van de UU',
            ],
            'does not abbreviate inside word' => [
                'Universiteit Utrechtfonds',
                'Universiteit Utrechtfonds',
            ],
        ];
    }

    #[DataProvider('provideAbbreviatedUniversities')]
    public function testDetectsAbbreviatedUniversities(string $word): void
    {
        $abbreviator = new UniversityAbbreviator();

        $this->assertTrue($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideAbbreviatedUniversities(): iterable
    {
        return [
            'uu' => ['uu'],
            'UU' => ['UU'],
            'lei' => ['lei'],
            'LEI' => ['LEI'],
            'ul' => ['ul'],
            'UL' => ['UL'],
            'eur' => ['eur'],
            'EUR' => ['EUR'],
            'ru' => ['ru'],
            'RU' => ['RU'],
            'ou' => ['ou'],
            'OU' => ['OU'],
            'uva' => ['uva'],
            'UvA' => ['UvA'],
            'vu' => ['vu'],
            'VU' => ['VU'],
            'rug' => ['rug'],
            'RUG' => ['RUG'],
            'tu/e' => ['tu/e'],
            'TU/e' => ['TU/e'],
            'tud' => ['tud'],
            'TUD' => ['TUD'],
            'ut' => ['ut'],
            'UT' => ['UT'],
            'tiu' => ['tiu'],
            'TiU' => ['TiU'],
            'wur' => ['wur'],
            'WUR' => ['WUR'],
        ];
    }

    #[DataProvider('provideUnabbreviatedUniversities')]
    public function testDoesNotDetectUnabbreviatedUniversities(string $word): void
    {
        $abbreviator = new UniversityAbbreviator();

        $this->assertFalse($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideUnabbreviatedUniversities(): iterable
    {
        return [
            'universiteit' => ['universiteit'],
            'hogeschool' => ['hogeschool'],
            'school' => ['school'],
            'empty string' => [''],
        ];
    }
}
