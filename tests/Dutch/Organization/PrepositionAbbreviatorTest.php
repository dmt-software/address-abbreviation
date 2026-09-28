<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\Dutch\Organization\PrepositionAbbreviator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Tests abbreviation of Dutch prepositions and connecting words in organization names.
 */
#[CoversClass(PrepositionAbbreviator::class)]
final class PrepositionAbbreviatorTest extends TestCase
{
    #[DataProvider('providePrepositions')]
    public function testAbbreviatesPrepositions(string $phrase, string $expected): void
    {
        $abbreviator = new PrepositionAbbreviator();

        $this->assertSame($expected, $abbreviator->abbreviate($phrase));
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function providePrepositions(): iterable
    {
        return [
            'van de' => [
                'Vrienden van de Universiteit Utrecht',
                'Vrienden vd Universiteit Utrecht',
            ],
            'Van de' => [
                'Vrienden Van de Universiteit Utrecht',
                'Vrienden vd Universiteit Utrecht',
            ],
            'van der' => [
                'Stichting van der Laan',
                'Stichting vd Laan',
            ],
            'van den' => [
                'Stichting van den Berg',
                'Stichting vd Berg',
            ],
            'van het' => [
                'Vrienden van het Museum',
                'Vrienden vh Museum',
            ],
            'Van het' => [
                'Vrienden Van het Museum',
                'Vrienden vh Museum',
            ],
            'aan de' => [
                'Stichting aan de Amstel',
                'Stichting ad Amstel',
            ],
            'aan den' => [
                'Stichting aan den Amstel',
                'Stichting ad Amstel',
            ],
            'aan het' => [
                'Stichting aan het Water',
                'Stichting ah Water',
            ],
            'achter de' => [
                'Stichting achter de Duinen',
                'Stichting ad Duinen',
            ],
            'achter den' => [
                'Stichting achter den Duinen',
                'Stichting ad Duinen',
            ],
            'achter het' => [
                'Stichting achter het Spoor',
                'Stichting ah Spoor',
            ],
            'case insensitive uppercase phrase' => [
                'Stichting VAN DE Zorg',
                'Stichting vd Zorg',
            ],
            'multiple prepositions' => [
                'Vrienden van de Stichting aan het Water',
                'Vrienden vd Stichting ah Water',
            ],
            'does not abbreviate inside word' => [
                'Voorvan de Stichting',
                'Voorvan de Stichting',
            ],
            'does not abbreviate partial word at end' => [
                'Stichting van derLaan',
                'Stichting van derLaan',
            ],
        ];
    }

    #[DataProvider('provideAbbreviatedPrepositions')]
    public function testDetectsAbbreviatedPrepositions(string $word): void
    {
        $abbreviator = new PrepositionAbbreviator();

        $this->assertTrue($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideAbbreviatedPrepositions(): iterable
    {
        return [
            'vd' => ['vd'],
            'VD' => ['VD'],
            'vh' => ['vh'],
            'VH' => ['VH'],
            'ad' => ['ad'],
            'AD' => ['AD'],
            'ah' => ['ah'],
            'AH' => ['AH'],
        ];
    }

    #[DataProvider('provideUnabbreviatedPrepositions')]
    public function testDoesNotDetectUnabbreviatedPrepositions(string $word): void
    {
        $abbreviator = new PrepositionAbbreviator();

        $this->assertFalse($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideUnabbreviatedPrepositions(): iterable
    {
        return [
            'van de' => ['van de'],
            'van der' => ['van der'],
            'van den' => ['van den'],
            'van het' => ['van het'],
            'aan de' => ['aan de'],
            'aan het' => ['aan het'],
            'achter de' => ['achter de'],
            'achter het' => ['achter het'],
            'empty string' => [''],
        ];
    }
}
