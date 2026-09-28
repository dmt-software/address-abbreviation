<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\Dutch\Organization\HealthcareAbbreviator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Tests abbreviation of Dutch healthcare and welfare organization names.
 */
#[CoversClass(HealthcareAbbreviator::class)]
final class HealthcareAbbreviatorTest extends TestCase
{
    #[DataProvider('provideHealthcareNames')]
    public function testAbbreviatesHealthcareNames(string $phrase, string $expected): void
    {
        $abbreviator = new HealthcareAbbreviator();

        $this->assertSame($expected, $abbreviator->abbreviate($phrase));
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function provideHealthcareNames(): iterable
    {
        return [
            'geestelijke gezondheidszorg' => [
                'Stichting Geestelijke Gezondheidszorg Noord-Holland',
                'Stichting GGZ Noord-Holland',
            ],
            'psychiatrie' => [
                'Centrum voor Psychiatrie Amsterdam',
                'Centrum voor Psych Amsterdam',
            ],
            'psychiatrisch' => [
                'Psychiatrisch Centrum Amsterdam',
                'Psych Centrum Amsterdam',
            ],
            'psychiater' => [
                'Praktijk Psychiater Jansen',
                'Praktijk Psych Jansen',
            ],
            'psychologie' => [
                'Praktijk Psychologie Jansen',
                'Praktijk Psych Jansen',
            ],
            'psychologisch' => [
                'Psychologisch Centrum Amsterdam',
                'Psych Centrum Amsterdam',
            ],
            'psycholoog' => [
                'Praktijk Psycholoog Jansen',
                'Praktijk Psych Jansen',
            ],
            'jeugdgezondheidszorg' => [
                'Jeugdgezondheidszorg Kennemerland',
                'JGZ Kennemerland',
            ],
            'gehandicaptenzorg' => [
                'Gehandicaptenzorg Nederland',
                'GHZ Nederland',
            ],
            'maatschappelijke dienstverlening' => [
                'Stichting Maatschappelijke Dienstverlening Utrecht',
                'Stichting MD Utrecht',
            ],
            'gezondheidscentrum' => [
                'Gezondheidscentrum Hoofddorp',
                'GC Hoofddorp',
            ],
            'medisch centrum' => [
                'Medisch Centrum Amsterdam',
                'MC Amsterdam',
            ],
            'zorgcentrum' => [
                'Zorgcentrum De Meer',
                'ZC De Meer',
            ],
            'woonzorgcentrum' => [
                'Woonzorgcentrum De Meer',
                'WZC De Meer',
            ],
            'zorggroep lowercase' => [
                'zorggroep Noord',
                'zorggrp Noord',
            ],
            'zorggroep uppercase' => [
                'Zorggroep Noord',
                'Zorggrp Noord',
            ],
            'huisartsenpraktijk' => [
                'Huisartsenpraktijk De Linde',
                'Hap De Linde',
            ],
            'tandartspraktijk' => [
                'Tandartspraktijk De Linde',
                'Tap De Linde',
            ],
            'fysiotherapie' => [
                'Fysiotherapie De Linde',
                'Fysio De Linde',
            ],
            'apotheek' => [
                'Apotheek De Linde',
                'Apoth De Linde',
            ],
            'verpleeghuis' => [
                'Verpleeghuis De Linde',
                'Vph De Linde',
            ],
            'thuiszorg' => [
                'Thuiszorg De Linde',
                'Tz De Linde',
            ],
            'kinderopvang' => [
                'Kinderopvang De Linde',
                'Ko De Linde',
            ],
            'buitenschoolse opvang' => [
                'Buitenschoolse Opvang De Linde',
                'BSO De Linde',
            ],
            'case insensitive' => [
                'medisch CENTRUM Amsterdam',
                'MC Amsterdam',
            ],
            'does not abbreviate inside word' => [
                'Zorgcentrumbestuur De Meer',
                'Zorgcentrumbestuur De Meer',
            ],
        ];
    }

    #[DataProvider('provideAbbreviatedHealthcareNames')]
    public function testDetectsAbbreviatedHealthcareNames(string $word): void
    {
        $abbreviator = new HealthcareAbbreviator();

        $this->assertTrue($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideAbbreviatedHealthcareNames(): iterable
    {
        return [
            'ggz' => ['ggz'],
            'JGZ' => ['JGZ'],
            'ghz' => ['ghz'],
            'MD' => ['MD'],
            'gc' => ['gc'],
            'MC' => ['MC'],
            'zc' => ['zc'],
            'WZC' => ['WZC'],
            'Zorggrp' => ['Zorggrp'],
            'hap' => ['hap'],
            'Tap' => ['Tap'],
            'fysio' => ['fysio'],
            'Apoth' => ['Apoth'],
            'vph' => ['vph'],
            'Tz' => ['Tz'],
            'Ko' => ['Ko'],
            'BSO' => ['BSO'],
        ];
    }

    #[DataProvider('provideUnabbreviatedHealthcareNames')]
    public function testDoesNotDetectUnabbreviatedHealthcareNames(string $word): void
    {
        $abbreviator = new HealthcareAbbreviator();

        $this->assertFalse($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideUnabbreviatedHealthcareNames(): iterable
    {
        return [
            'gezondheidscentrum' => ['gezondheidscentrum'],
            'zorgcentrum' => ['zorgcentrum'],
            'zorggroep' => ['zorggroep'],
            'apotheek' => ['apotheek'],
            'empty string' => [''],
        ];
    }
}
