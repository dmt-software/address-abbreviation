<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\Dutch\Organization\MinistryAbbreviator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(MinistryAbbreviator::class)]
final class MinistryAbbreviatorTest extends TestCase
{
    #[DataProvider('provideMinistryNames')]
    public function testAbbreviatesMinistryNames(string $phrase, string $expected): void
    {
        $abbreviator = new MinistryAbbreviator();

        $this->assertSame($expected, $abbreviator->abbreviate($phrase));
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function provideMinistryNames(): iterable
    {
        return [
            'algemene zaken' => [
                'Ministerie van Algemene Zaken',
                'Ministerie van AZ',
            ],
            'binnenlandse zaken en koninkrijksrelaties' => [
                'Ministerie van Binnenlandse Zaken en Koninkrijksrelaties',
                'Ministerie van BZK',
            ],
            'buitenlandse zaken' => [
                'Ministerie van Buitenlandse Zaken',
                'Ministerie van BZ',
            ],
            'defensie' => [
                'Ministerie van Defensie',
                'Ministerie van Defensie',
            ],
            'economische zaken en klimaat' => [
                'Ministerie van Economische Zaken en Klimaat',
                'Ministerie van EZK',
            ],
            'economische zaken' => [
                'Ministerie van Economische Zaken',
                'Ministerie van EZ',
            ],
            'financien without diaeresis' => [
                'Ministerie van Financien',
                'Ministerie van FIN',
            ],
            'financiën with diaeresis' => [
                'Ministerie van Financiën',
                'Ministerie van FIN',
            ],
            'infrastructuur en waterstaat' => [
                'Ministerie van Infrastructuur en Waterstaat',
                'Ministerie van IenW',
            ],
            'justitie en veiligheid' => [
                'Ministerie van Justitie en Veiligheid',
                'Ministerie van JenV',
            ],
            'landbouw visserij voedselzekerheid en natuur with comma after landbouw' => [
                'Ministerie van Landbouw, Visserij, Voedselzekerheid en Natuur',
                'Ministerie van LVVN',
            ],
            'landbouw visserij voedselzekerheid en natuur without comma after landbouw' => [
                'Ministerie van Landbouw Visserij, Voedselzekerheid en Natuur',
                'Ministerie van LVVN',
            ],
            'onderwijs cultuur en wetenschap with comma' => [
                'Ministerie van Onderwijs, Cultuur en Wetenschap',
                'Ministerie van OCW',
            ],
            'onderwijs cultuur en wetenschap without comma' => [
                'Ministerie van Onderwijs Cultuur en Wetenschap',
                'Ministerie van OCW',
            ],
            'sociale zaken en werkgelegenheid' => [
                'Ministerie van Sociale Zaken en Werkgelegenheid',
                'Ministerie van SZW',
            ],
            'volksgezondheid welzijn en sport with comma' => [
                'Ministerie van Volksgezondheid, Welzijn en Sport',
                'Ministerie van VWS',
            ],
            'volksgezondheid welzijn en sport without comma' => [
                'Ministerie van Volksgezondheid Welzijn en Sport',
                'Ministerie van VWS',
            ],
            'volkshuisvesting en ruimtelijke ordening' => [
                'Ministerie van Volkshuisvesting en Ruimtelijke Ordening',
                'Ministerie van VRO',
            ],
            'volkshuisvesting ruimtelijke ordening en milieubeheer with comma' => [
                'Ministerie van Volkshuisvesting, Ruimtelijke Ordening en Milieubeheer',
                'Ministerie van VROM',
            ],
            'volkshuisvesting ruimtelijke ordening en milieubeheer without comma' => [
                'Ministerie van Volkshuisvesting Ruimtelijke Ordening en Milieubeheer',
                'Ministerie van VROM',
            ],
            'case insensitive' => [
                'ministerie van ALGEMENE ZAKEN',
                'ministerie van AZ',
            ],
            'inside sentence' => [
                'Directie van het Ministerie van Algemene Zaken',
                'Directie van het Ministerie van AZ',
            ],
            'does not abbreviate without ministerie van prefix' => [
                'Algemene Zaken',
                'Algemene Zaken',
            ],
            'does not abbreviate inside word' => [
                'Ministerie van Algemene Zakendienst',
                'Ministerie van Algemene Zakendienst',
            ],
        ];
    }

    #[DataProvider('provideAbbreviatedMinistryNames')]
    public function testDetectsAbbreviatedMinistryNames(string $word): void
    {
        $abbreviator = new MinistryAbbreviator();

        $this->assertTrue($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideAbbreviatedMinistryNames(): iterable
    {
        return [
            'az' => ['az'],
            'BZK' => ['BZK'],
            'bz' => ['bz'],
            'Defensie' => ['Defensie'],
            'ezk' => ['ezk'],
            'EZ' => ['EZ'],
            'fin' => ['fin'],
            'IenW' => ['IenW'],
            'jenv' => ['jenv'],
            'LVVN' => ['LVVN'],
            'ocw' => ['ocw'],
            'SZW' => ['SZW'],
            'vws' => ['vws'],
            'VRO' => ['VRO'],
            'vrom' => ['vrom'],
        ];
    }

    #[DataProvider('provideUnabbreviatedMinistryNames')]
    public function testDoesNotDetectUnabbreviatedMinistryNames(string $word): void
    {
        $abbreviator = new MinistryAbbreviator();

        $this->assertFalse($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideUnabbreviatedMinistryNames(): iterable
    {
        return [
            'ministerie' => ['ministerie'],
            'ministerie van' => ['ministerie van'],
            'algemene zaken' => ['algemene zaken'],
            'binnenlandse zaken' => ['binnenlandse zaken'],
            'volksgezondheid welzijn en sport' => ['volksgezondheid welzijn en sport'],
            'empty string' => [''],
        ];
    }
}
