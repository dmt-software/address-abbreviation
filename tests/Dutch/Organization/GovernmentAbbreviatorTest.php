<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\Dutch\Organization\GovernmentAbbreviator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(GovernmentAbbreviator::class)]
final class GovernmentAbbreviatorTest extends TestCase
{
    #[DataProvider('provideGovernmentNames')]
    public function testAbbreviatesGovernmentNames(string $phrase, string $expected): void
    {
        $abbreviator = new GovernmentAbbreviator();

        $this->assertSame($expected, $abbreviator->abbreviate($phrase));
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function provideGovernmentNames(): iterable
    {
        return [
            'kamer van koophandel' => [
                'Kamer van Koophandel Amsterdam',
                'KvK Amsterdam',
            ],
            'gemeentelijke gezondheidsdienst' => [
                'Gemeentelijke Gezondheidsdienst Kennemerland',
                'GGD Kennemerland',
            ],
            'openbaar ministerie' => [
                'Openbaar Ministerie Noord-Holland',
                'OM Noord-Holland',
            ],
            'raad van state' => [
                'Raad van State',
                'RvS',
            ],
            'omgevingsdienst' => [
                'Omgevingsdienst Noordzeekanaalgebied',
                'OD Noordzeekanaalgebied',
            ],
            'belastingdienst' => [
                'Belastingdienst Amsterdam',
                'BD Amsterdam',
            ],
            'rijksdienst' => [
                'Rijksdienst voor Ondernemend Nederland',
                'RD voor Ondernemend Nederland',
            ],
            'gemeente lowercase' => [
                'gemeente Haarlemmermeer',
                'gem Haarlemmermeer',
            ],
            'gemeente uppercase' => [
                'Gemeente Haarlemmermeer',
                'Gem Haarlemmermeer',
            ],
            'provincie' => [
                'Provincie Noord-Holland',
                'Prov Noord-Holland',
            ],
            'ministerie' => [
                'Ministerie van Financiën',
                'Min van Financiën',
            ],
            'rechtbank' => [
                'Rechtbank Amsterdam',
                'Rb Amsterdam',
            ],
            'waterschap' => [
                'Waterschap Rijnland',
                'Ws Rijnland',
            ],
            'case insensitive' => [
                'gemeente HAARLEMMERMEER',
                'gem HAARLEMMERMEER',
            ],
            'multiple government terms' => [
                'Gemeente Amsterdam Omgevingsdienst',
                'Gem Amsterdam OD',
            ],
            'does not abbreviate inside word' => [
                'Gemeenteraad Haarlemmermeer',
                'Gemeenteraad Haarlemmermeer',
            ],
        ];
    }

    #[DataProvider('provideAbbreviatedGovernmentNames')]
    public function testDetectsAbbreviatedGovernmentNames(string $word): void
    {
        $abbreviator = new GovernmentAbbreviator();

        $this->assertTrue($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideAbbreviatedGovernmentNames(): iterable
    {
        return [
            'KvK' => ['KvK'],
            'ggd' => ['ggd'],
            'om' => ['om'],
            'RvS' => ['RvS'],
            'gsd' => ['gsd'],
            'OD' => ['OD'],
            'BD' => ['BD'],
            'rd' => ['rd'],
            'Gem' => ['Gem'],
            'prov' => ['prov'],
            'Min' => ['Min'],
            'rb' => ['rb'],
            'Ws' => ['Ws'],
        ];
    }

    #[DataProvider('provideUnabbreviatedGovernmentNames')]
    public function testDoesNotDetectUnabbreviatedGovernmentNames(string $word): void
    {
        $abbreviator = new GovernmentAbbreviator();

        $this->assertFalse($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideUnabbreviatedGovernmentNames(): iterable
    {
        return [
            'gemeente' => ['gemeente'],
            'provincie' => ['provincie'],
            'ministerie' => ['ministerie'],
            'waterschap' => ['waterschap'],
            'empty string' => [''],
        ];
    }
}
