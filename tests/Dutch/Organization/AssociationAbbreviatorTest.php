<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\Dutch\Organization\AssociationAbbreviator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(AssociationAbbreviator::class)]
final class AssociationAbbreviatorTest extends TestCase
{
    #[DataProvider('provideAssociations')]
    public function testAbbreviatesAssociations(string $phrase, string $expected): void
    {
        $abbreviator = new AssociationAbbreviator();

        $this->assertSame($expected, $abbreviator->abbreviate($phrase));
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function provideAssociations(): iterable
    {
        return [
            'vereniging van eigenaren' => [
                'Vereniging van Eigenaren Parkzicht',
                'VvE Parkzicht',
            ],
            'vereniging openbaar onderwijs' => [
                'Vereniging Openbaar Onderwijs',
                'VOO',
            ],
            'voetbalvereniging' => [
                'VoetbalVereniging De Brug',
                'VV De Brug',
            ],
            'sportvereniging' => [
                'Sportvereniging De Brug',
                'SV De Brug',
            ],
            'generic vereniging' => [
                'Vereniging over de Brug',
                'Ver over de Brug',
            ],
            'case insensitive' => [
                'voetbalVERENIGING De Brug',
                'VV De Brug',
            ],
            'does not abbreviate inside word' => [
                'Verenigingsbestuur De Brug',
                'Verenigingsbestuur De Brug',
            ],
        ];
    }

    #[DataProvider('provideAbbreviatedAssociations')]
    public function testDetectsAbbreviatedAssociations(string $word): void
    {
        $abbreviator = new AssociationAbbreviator();

        $this->assertTrue($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideAbbreviatedAssociations(): iterable
    {
        return [
            'VvE' => ['VvE'],
            'VOO' => ['voo'],
            'VV' => ['VV'],
            'SV' => ['SV'],
            'ver' => ['ver'],
        ];
    }

    #[DataProvider('provideUnabbreviatedAssociations')]
    public function testDoesNotDetectUnabbreviatedAssociations(string $word): void
    {
        $abbreviator = new AssociationAbbreviator();

        $this->assertFalse($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideUnabbreviatedAssociations(): iterable
    {
        return [
            'vereniging' => ['vereniging'],
            'voetbalvereniging' => ['voetbalvereniging'],
            'vereniging van eigenaren' => ['vereniging van eigenaren'],
            'organisatie' => ['organisatie'],
            'empty string' => [''],
        ];
    }
}
