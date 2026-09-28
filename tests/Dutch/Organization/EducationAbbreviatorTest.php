<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\Dutch\Organization\EducationAbbreviator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(EducationAbbreviator::class)]
final class EducationAbbreviatorTest extends TestCase
{
    #[DataProvider('provideEducationNames')]
    public function testAbbreviatesEducationNames(string $phrase, string $expected): void
    {
        $abbreviator = new EducationAbbreviator();

        $this->assertSame($expected, $abbreviator->abbreviate($phrase));
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function provideEducationNames(): iterable
    {
        return [
            'protestants christelijke basisschool' => [
                'Protestants Christelijke Basisschool De Regenboog',
                'PCBS De Regenboog',
            ],
            'protestants-christelijke basisschool' => [
                'Protestants-Christelijke Basisschool De Regenboog',
                'PCBS De Regenboog',
            ],
            'rooms katholieke basisschool' => [
                'Rooms Katholieke Basisschool De Regenboog',
                'RKBS De Regenboog',
            ],
            'rooms-katholieke basisschool' => [
                'Rooms-Katholieke Basisschool De Regenboog',
                'RKBS De Regenboog',
            ],
            'openbare basisschool' => [
                'Openbare Basisschool De Regenboog',
                'OBS De Regenboog',
            ],
            'christelijke basisschool' => [
                'Christelijke Basisschool De Regenboog',
                'CBS De Regenboog',
            ],
            'integraal kindcentrum' => [
                'Integraal Kindcentrum De Regenboog',
                'IKC De Regenboog',
            ],
            'kindcentrum' => [
                'Kindcentrum De Regenboog',
                'KC De Regenboog',
            ],
            'basisschool' => [
                'Basisschool De Regenboog',
                'BS De Regenboog',
            ],
            'scholengemeenschap' => [
                'Scholengemeenschap Spinoza',
                'SG Spinoza',
            ],
            'voortgezet onderwijs' => [
                'Stichting Voortgezet Onderwijs Haarlemmermeer',
                'Stichting VO Haarlemmermeer',
            ],
            'middelbaar beroepsonderwijs' => [
                'Middelbaar Beroepsonderwijs College Airport',
                'MBO College Airport',
            ],
            'hoger beroepsonderwijs' => [
                'Hoger Beroepsonderwijs Nederland',
                'HBO Nederland',
            ],
            'hogeschool' => [
                'Hogeschool Inholland',
                'HS Inholland',
            ],
            'lyceum' => [
                'Kaj Munk Lyceum',
                'Kaj Munk Lyc',
            ],
            'gymnasium' => [
                'Stedelijk Gymnasium Haarlem',
                'Stedelijk Gym Haarlem',
            ],
            'case insensitive' => [
                'openbare BASISSCHOOL De Regenboog',
                'OBS De Regenboog',
            ],
            'multiple education terms' => [
                'Stichting Openbare Basisschool en Kindcentrum De Brug',
                'Stichting OBS en KC De Brug',
            ],
            'does not abbreviate inside word' => [
                'Basisschoolbestuur De Regenboog',
                'Basisschoolbestuur De Regenboog',
            ],
        ];
    }

    #[DataProvider('provideAbbreviatedEducationNames')]
    public function testDetectsAbbreviatedEducationNames(string $word): void
    {
        $abbreviator = new EducationAbbreviator();

        $this->assertTrue($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideAbbreviatedEducationNames(): iterable
    {
        return [
            'PCBS' => ['PCBS'],
            'rkbs' => ['rkbs'],
            'obs' => ['obs'],
            'cbs' => ['cbs'],
            'ikc' => ['ikc'],
            'KC' => ['KC'],
            'BS' => ['BS'],
            'sg' => ['sg'],
            'vo' => ['vo'],
            'mbo' => ['mbo'],
            'HBO' => ['HBO'],
            'hs' => ['hs'],
            'lyc' => ['lyc'],
            'Gym' => ['Gym'],
        ];
    }

    #[DataProvider('provideUnabbreviatedEducationNames')]
    public function testDoesNotDetectUnabbreviatedEducationNames(string $word): void
    {
        $abbreviator = new EducationAbbreviator();

        $this->assertFalse($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideUnabbreviatedEducationNames(): iterable
    {
        return [
            'basisschool' => ['basisschool'],
            'kindcentrum' => ['kindcentrum'],
            'universiteit' => ['universiteit'],
            'hogeschool' => ['hogeschool'],
            'organisatie' => ['organisatie'],
            'empty string' => [''],
        ];
    }
}
