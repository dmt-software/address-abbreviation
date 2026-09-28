<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\Dutch\Organization\LegalFormAbbreviator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(LegalFormAbbreviator::class)]
final class LegalFormAbbreviatorTest extends TestCase
{
    #[DataProvider('provideLegalForms')]
    public function testAbbreviatesLegalForms(string $phrase, string $expected): void
    {
        $abbreviator = new LegalFormAbbreviator();

        $this->assertSame($expected, $abbreviator->abbreviate($phrase));
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function provideLegalForms(): iterable
    {
        return [
            'besloten vennootschap' => [
                'Jansen Advies Besloten Vennootschap',
                'Jansen Advies BV',
            ],
            'naamloze vennootschap' => [
                'Jansen Advies Naamloze Vennootschap',
                'Jansen Advies NV',
            ],
            'vennootschap onder firma' => [
                'Jansen Advies Vennootschap onder Firma',
                'Jansen Advies VOF',
            ],
            'commanditaire vennootschap' => [
                'Jansen Advies Commanditaire Vennootschap',
                'Jansen Advies CV',
            ],
            'cooperatie without diaeresis' => [
                'Cooperatie Jansen',
                'Coop Jansen',
            ],
            'coöperatie with diaeresis' => [
                'Coöperatie Jansen',
                'Coop Jansen',
            ],
            'maatschap' => [
                'Maatschap Jansen',
                'Mts Jansen',
            ],
            'stichting' => [
                'Stichting Jansen',
                'Stg Jansen',
            ],
            'case insensitive' => [
                'jansen besloten VENNOOTSCHAP',
                'jansen BV',
            ],
            'multiple legal forms' => [
                'Stichting Jansen Besloten Vennootschap',
                'Stg Jansen BV',
            ],
            'does not abbreviate inside word' => [
                'Stichtingsbestuur Jansen',
                'Stichtingsbestuur Jansen',
            ],
            'does not abbreviate partial legal form inside word' => [
                'Jansenbesloten vennootschap',
                'Jansenbesloten vennootschap',
            ],
        ];
    }

    #[DataProvider('provideAbbreviatedLegalForms')]
    public function testDetectsAbbreviatedLegalForms(string $word): void
    {
        $abbreviator = new LegalFormAbbreviator();

        $this->assertTrue($abbreviator->isAbbreviated($word));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function provideAbbreviatedLegalForms(): iterable
    {
        return [
            'bv' => ['bv'],
            'nv' => ['NV'],
            'vof' => ['vof'],
            'cv' => ['CV'],
            'coop' => ['Coop'],
            'mts' => ['mts'],
            'stg' => ['Stg'],
        ];
    }

    #[DataProvider('provideUnabbreviatedLegalForms')]
    public function testDoesNotDetectUnabbreviatedLegalForms(string $word): void
    {
        $abbreviator = new LegalFormAbbreviator();

        $this->assertFalse($abbreviator->isAbbreviated($word));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function provideUnabbreviatedLegalForms(): iterable
    {
        return [
            'besloten vennootschap' => ['besloten vennootschap'],
            'naamloze vennootschap' => ['naamloze vennootschap'],
            'stichting' => ['stichting'],
            'vereniging' => ['vereniging'],
            'bedrijf' => ['bedrijf'],
            'empty string' => [''],
        ];
    }
}
